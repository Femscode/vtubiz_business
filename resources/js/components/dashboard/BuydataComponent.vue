<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->

      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="buyData()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-md-3"></label>

            <div class="col">
              <h4 class="font-weight-bold"><b>Buy Data</b></h4>
            </div>
            <div class="col text-end">
              <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Phone Number</h6>
            <div class="col-md-6">
              <input required @input="fetchNetwork()" v-model="phone_number"
                class="form-control form-control-lg form-control-solid" type="text" placeholder="08000000000" />
              <div class="col-md-12 text-end">
                <a @click="selectFromBeneficiary()" class="btn btn-primary btn-sm">Select From Beneficiary</a>
              </div>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Network</h6>
            <div class="col-md-6">
              <select required @change="fetchPlan()" v-model="network" class="form-control">
                <option value="1">MTN</option>
                <option value="2">GLO</option>
                <option value="3">AIRTEL</option>
                <option value="4">9MOBILE</option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Plan</h6>
            <div class="col-md-6">
              <select required v-model="selectedPlan" class="form-control">
                <!-- <option value="">Select Plan</option> -->
                <option :data-price="plan.actual_price" :key="plan.id" v-for="plan in plans" :value="plan.plan_id">
                  {{ plan.plan_name }} - (₦{{ plan.admin_price }})
                </option>
              </select>
              <div class="form-check form-switch form-sm">
                <input class="form-check-input" type="checkbox" id="save_ben" @change="saveBeneficiary" />
                <label id="alr_saved" class="form-check-label">Save as beneficiary</label>
              </div>
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <div class="btn-group btn-group-example mb-3 col-md-6" role="group">
              <button :disabled="!transfer_status" type="submit" class="btn btn-primary col-md-3">
                Buy Now
              </button>
              <button :disabled="!transfer_status" type="button" @click="scheduleBuy" class="btn btn-success col-md-3">
                Buy For Later
              </button>
            </div>
          </div>

          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <ul>
                <li>Universal Code (For All Networks) >> *323# or *323*4#</li>
                <li>
                  MTN (CG) >> #460*260# | MTN (SME) >> *461*4# OR *323*3# | MTN
                  (Direct & DATACARD) >> *323*4#
                </li>

                <li>GLO (CG & Direct) >> *127*0#</li>
                <li>Airtel (CG & Direct) >> *140#</li>
                <li>9mobile (Direct & SME) >> *228#</li>
              </ul>
            </div>
          </div>
        </div>
      </form>
      <!--end::Form-->
    </div>
    <!--end::Card-->
  </div>
</template>

<script>
export default {
  props: ["user", "company", "beneficiaries"],
  data() {
    return {
      phone_number: "",
      network: "",
      selectedPlan: "",
      plans: [],
      ben_name: "",
      transfer_status: false,
    };
  },
  methods: {
    fetchNetwork() {
      if (this.phone_number.length >= 10 && this.phone_number.length <= 12) {
        axios
          .get("/fetchnetwork/" + this.phone_number)
          .then((response) => {
            console.log(response);
            if (response.data !== 0) {
              this.network = response.data;
              this.fetchPlan();
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        (this.selectedPlan = null), (this.plans = []);
        this.network = null;
        this.transfer_status = false;
        // this.network = "";
      }
    },
    fetchPlan() {
      if (this.phone_number.length >= 10) {
        console.log(this.network, "this one");
        axios
          .get("/fetchplan/" + this.network)
          .then((response) => {
            console.log(response);
            if (response.data !== false) {
              this.selectedPlan = response.data[0].plan_id;
              this.plans = response.data;
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        // this.transfer_status = false;
        // this.network = "";
      }
    },
    scheduleBuy() {
      Swal.fire({
        title: "Select To Schedule Purchase",
        html:
          "<input id='sweet_alert_date' class='form-control form-input' min='" +
          new Date().toISOString().split("T")[0] +
          "' type='date'/><br><input id='sweet_alert_time' class='form-control form-input' type='time' />",
        showCancelButton: true,
        preConfirm: () => {
          // Get the selected date from the date picker
          const selectedDate =
            document.getElementById("sweet_alert_date").value;
          const selectedTime =
            document.getElementById("sweet_alert_time").value;
          this.buyData(
            selectedDate,
            selectedTime,
            "Scheduling your purchase, please wait"
          );
          // Do something with the selected date
          console.log("Selected Date:", selectedDate, selectedTime);
        },
      });
    },
    selectFromBeneficiary() {
      const options = this.beneficiaries
        .map((beneficiary) => {
          return `<option value="${beneficiary.phone}">${beneficiary.name} (${beneficiary.phone})</option>`;
        })
        .join("");
      Swal.fire({
        title: "Choose Beneficiary",
        html: `<select  class='form-control' required id='beneficiary_choice'><option>--Choose Beneficiary--</option>${options}</select>`,
        showCancelButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          this.phone_number = $("#beneficiary_choice").val();
          this.ben_name = $("#beneficiary_choice").find(":selected").text();
          $("#save_ben").prop("checked", true);
          $("#alr_saved").text(
            "Already Saved, toggle to remove from beneficiary"
          );
          this.fetchNetwork();
        }
      });
    },
    saveBeneficiary(event) {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      if (event.target.checked) {
        if (this.transfer_status) {
          Swal.fire({
            title: "Name Of Beneficiary",
            html: `<input class='form-control' type='text' placeholder='My Sweetheart 🥰❤️' required id='beneficiary_name'/>`,
            showCancelButton: true,
            confirmButtonText: "Save",
          }).then((result) => {
            if (result.isConfirmed) {
              this.ben_name = $("#beneficiary_name").val();

              let fd = new FormData();
              fd.append("phone", this.phone_number);
              fd.append("name", this.ben_name);
              axios
                .post("/saveBeneficiary", fd)
                .then((response) => {
                  console.log(response.data, "the data");
                  $("#save_ben").prop("checked", true);
                  $("#alr_saved").text(
                    "Beneficiary Saved, toggle to save to beneficiary"
                  );
                  if (response.data.success == true) {
                    Toast.fire({
                      icon: "success",
                      title: "Beneficiary Saved!",
                    });
                  } else {
                    Toast.fire({
                      icon: "info",
                      title: "Beneficiary already exist",
                    });
                  }
                })
                .catch((error) => {
                  console.log(error.message);
                  Swal.fire(error.message);
                });
            }
          });
        } else {
          Toast.fire({
            icon: "info",
            title: "Invalid Phone Number",
          });
        }
      } else {
        Swal.fire({
          title: "Remove Contact?",
          text: `Are you sure you want to remove ${this.ben_name} from beneficiary`,
          showCancelButton: true,
          confirmButtonText: "Yes, I'm Sure",
        }).then((result) => {
          if (result.isConfirmed) {
            $("#save_ben").prop("checked", false);
            $("#alr_saved").text(
              "Removed from beneficiary, toggle to save to beneficiary"
            );
            let fd = new FormData();
            fd.append("phone", this.phone_number);
            axios
              .post("/removeBeneficiary", fd)
              .then((response) => {
                console.log(response.data, "the data");
                if (response.data.success == true) {
                  Toast.fire({
                    icon: "success",
                    title: "Beneficiary Removed!",
                  });
                } else {
                  Toast.fire({
                    icon: "info",
                    title: "Beneficiary can't be removed",
                  });
                }
              })
              .catch((error) => {
                console.log(error.message);
                Swal.fire(error.message);
              });
          }
        });
      }
    },
    newbuyData(selectedDate = null, selectedTime = null, SwalContent = null) {
      if (this.transfer_status) {
        Swal.fire({
          title: "Input your four(4) digit pin to proceed",
          icon: "warning",
          input: "password",
          inputAttributes: {
            inputmode: "numeric",
            maxlength: 4,
            autocomplete: "new-password",
            name: "my-pin",
            autocapitalize: "off",
            pattern: "[0-9]*",
            style: "text-align:center;font-size:24px;letter-spacing: 20px",
          },
          showCancelButton: true,
          confirmButtonColor: "#ebab21",
          cancelButtonColor: "grey",
          confirmButtonText: "Buy Data",
          allowOutsideClick: false,
          allowEscapeKey: false,
          preConfirm: () => {
            const confirmButton = Swal.getConfirmButton();
            confirmButton.textContent = "Validating ";
            confirmButton.disabled = true;
            confirmButton.insertAdjacentHTML(
              "beforeend",
              `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
            return new Promise((resolve) => {
              // You can perform any necessary validation here, e.g. making a server call.
              // Once validation is complete, call resolve() to close the modal.
              setTimeout(() => {
                resolve();
              }, 500);
            });
          },

          inputValidator: (text) => {
            if (!/^\d{4}$/.test(text)) {
              return "Please enter a four-digit PIN";
            }
          },
        }).then((result) => {
          if (result.isConfirmed == false) {
            return;
          }
          const swalMessage =
            SwalContent !== null
              ? SwalContent
              : "Purchasing data, please wait...";
          Swal.fire({
            title: swalMessage,
            // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });
          let fd = new FormData();
          fd.append("phone_number", this.phone_number);
          fd.append("network", this.network);
          fd.append("plan", this.selectedPlan);
          fd.append("pin", result.value);
          if (selectedDate !== null) {
            fd.append("selectedDate", selectedDate);
            fd.append("selectedTime", selectedTime);
          }
          axios
            .post("/buydata", fd)
            .then((response) => {
              console.log(response, "the res");
              if (response.data.success == "true") {
                Swal.fire({
                  icon: "success",
                  title: "Purchase successful!",
                  showConfirmButton: true, // updated
                  confirmButtonColor: "#3085d6", // added
                  confirmButtonText: "Ok", // added
                  allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                  allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
              } else if (response.data == "schedule_saved") {
                Swal.fire({
                  icon: "success",
                  title: "Data Purchase Scheduled For Later Successfully!",
                  // text: "Updating...",
                  showConfirmButton: true, // updated
                  confirmButtonColor: "#3085d6", // added
                  confirmButtonText: "Ok", // added
                  allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                  allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
              } else {
                if (response.data.type == 'duplicate') {
                  Swal.fire({
                    icon: "error",
                    title: response.data.message,
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Data Received!",
                    cancelButtonText: "No, Data Not Received!",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    customClass: {
                      actions: 'custom-actions-class' // add a custom class to actions for styling
                    },
                    showCloseButton: true, // show a close button to dismiss the modal
                    showLoaderOnConfirm: true, // display a loader animation when Confirm is clicked
                    preConfirm: () => {
                      return new Promise((resolve) => {
                        setTimeout(() => {
                          resolve();
                        }, 2000); // Add a delay (2 seconds) to simulate a process
                      });
                    },
                  }).then((result) => {
                    if (result.isConfirmed) {
                      axios
                        .get("/user_delete_duplicate")
                        .then((response) => {
                          console.log(response);
                          if (response.data == true) {
                            Swal.fire({
                              icon: "success",
                              title: "Previous Transaction Verified! You can now proceed with the current transaction",
                              showConfirmButton: true,
                              confirmButtonColor: "#3085d6",
                              confirmButtonText: "Ok"
                            });
                          }
                        })
                        .catch((error) => {

                          console.log(error.message);
                        });
                      // This code block is executed when the "Confirm" button is clicked.

                    } else {
                      // This code block is executed when the "Deny" button is clicked.
                      Swal.fire({
                        title: "Please reach out to the admin to sort out this issue",
                        showCloseButton: true,
                        customClass: {
                          actions: 'custom-actions-class' // add the same custom class for styling
                        },
                        showCancelButton: true,
                        cancelButtonColor: "#3085d6",
                        confirmButtonColor: "#25d366",
                        confirmButtonText: "Chat with Admin",
                        cancelButtonText: "Not Now"
                      }).then((chatResult) => {
                        if (chatResult.isConfirmed) {
                          // Add your code to open a chat with the admin (e.g., redirect to WhatsApp)
                          window.location.href = "https://wa.me/2349058744473";
                        }
                      });
                    }
                  });


                }
                else {
                  Swal.fire({
                    icon: "error",
                    // title: response.data.message,
                    title: response.data.message,
                    // text: "Updating...",
                    showConfirmButton: true, // updated
                    confirmButtonColor: "#3085d6", // added
                    confirmButtonText: "Ok", // added
                    allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                    allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // location.reload();
                    }
                  });

                }

              }
            })
            .catch((error) => {
              console.log(error.message);
              Swal.fire(error.message);
            });
        });
      } else {
        Swal.fire({
          title: "Insufficient balance!,",
          icon: "info",
          html:
            "Click " +
            '<a href="https://vtubiz.com/fundwallet">here</a> ' +
            "to fund your wallet.",
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
        });
      }
    },

    buyData(selectedDate = null, selectedTime = null, SwalContent = null) {
      if (this.transfer_status) {
        Swal.fire({
          title: "Input your four(4) digit pin to proceed",
          icon: "warning",
          input: "password",
          inputAttributes: {
            inputmode: "numeric",
            maxlength: 4,
            autocomplete: "new-password",
            name: "my-pin",
            autocapitalize: "off",
            pattern: "[0-9]*",
            style: "text-align:center;font-size:24px;letter-spacing: 20px",
          },
          showCancelButton: true,
          confirmButtonColor: "#ebab21",
          cancelButtonColor: "grey",
          confirmButtonText: "Buy Data",
          allowOutsideClick: false,
          allowEscapeKey: false,
          preConfirm: () => {
            const confirmButton = Swal.getConfirmButton();
            confirmButton.textContent = "Validating ";
            confirmButton.disabled = true;
            confirmButton.insertAdjacentHTML(
              "beforeend",
              `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
            return new Promise((resolve) => {
              // You can perform any necessary validation here, e.g. making a server call.
              // Once validation is complete, call resolve() to close the modal.
              setTimeout(() => {
                resolve();
              }, 500);
            });
          },

          inputValidator: (text) => {
            if (!/^\d{4}$/.test(text)) {
              return "Please enter a four-digit PIN";
            }
          },
        }).then((result) => {
          if (result.isConfirmed == false) {
            return;
          }
          const swalMessage =
            SwalContent !== null
              ? SwalContent
              : "Purchasing data, please wait...";
          Swal.fire({
            title: swalMessage,
            // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });
          let fd = new FormData();
          fd.append("phone_number", this.phone_number);
          fd.append("network", this.network);
          fd.append("plan", this.selectedPlan);
          fd.append("pin", result.value);
          if (selectedDate !== null) {
            fd.append("selectedDate", selectedDate);
            fd.append("selectedTime", selectedTime);
          }
          axios
            .post("/buydata", fd)
            .then((response) => {
              console.log(response, "the res");
              if (response.data.success == "true") {
                Swal.fire({
                  icon: "success",
                  title: "Purchase successful!",
                  showConfirmButton: true, // updated
                  confirmButtonColor: "#3085d6", // added
                  confirmButtonText: "Ok", // added
                  allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                  allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
              } else if (response.data == "schedule_saved") {
                Swal.fire({
                  icon: "success",
                  title: "Data Purchase Scheduled For Later Successfully!",
                  // text: "Updating...",
                  showConfirmButton: true, // updated
                  confirmButtonColor: "#3085d6", // added
                  confirmButtonText: "Ok", // added
                  allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                  allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
              } else {
                if (response.data.type == 'duplicate') {
                  Swal.fire({
                    icon: "error",
                    title: response.data.message,
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Data Received!",
                    cancelButtonText: "No, Data Not Received!",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    customClass: {
                      actions: 'custom-actions-class' // add a custom class to actions for styling
                    },
                    showCloseButton: true, // show a close button to dismiss the modal
                    showLoaderOnConfirm: true, // display a loader animation when Confirm is clicked
                    preConfirm: () => {
                      return new Promise((resolve) => {
                        setTimeout(() => {
                          resolve();
                        }, 2000); // Add a delay (2 seconds) to simulate a process
                      });
                    },
                  }).then((result) => {
                    if (result.isConfirmed) {
                      axios
                        .get("/user_delete_duplicate")
                        .then((response) => {
                          console.log(response);
                          if (response.data == true) {
                            Swal.fire({
                              icon: "success",
                              title: "Previous Transaction Verified! You can now proceed with the current transaction",
                              showConfirmButton: true,
                              confirmButtonColor: "#3085d6",
                              confirmButtonText: "Ok"
                            });
                          }
                        })
                        .catch((error) => {

                          console.log(error.message);
                        });
                      // This code block is executed when the "Confirm" button is clicked.

                    } else {
                      // This code block is executed when the "Deny" button is clicked.
                      Swal.fire({
                        title: "Please reach out to the admin to sort out this issue",
                        showCloseButton: true,
                        customClass: {
                          actions: 'custom-actions-class' // add the same custom class for styling
                        },
                        showCancelButton: true,
                        cancelButtonColor: "#3085d6",
                        confirmButtonColor: "#25d366",
                        confirmButtonText: "Chat with Admin",
                        cancelButtonText: "Not Now"
                      }).then((chatResult) => {
                        if (chatResult.isConfirmed) {
                          // Add your code to open a chat with the admin (e.g., redirect to WhatsApp)
                          window.location.href = "https://wa.me/2348128722501";
                        }
                      });
                    }
                  });


                }
                else {
                  Swal.fire({
                    icon: "error",
                    // title: response.data.message,
                    title: response.data.message,
                    // text: "Updating...",
                    showConfirmButton: true, // updated
                    confirmButtonColor: "#3085d6", // added
                    confirmButtonText: "Ok", // added
                    allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                    allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // location.reload();
                    }
                  });

                }

              }
            })
            .catch((error) => {
              console.log(error.message);
              Swal.fire(error.message);
            });
        });
      } else {
        Swal.fire({
          title: "Insufficient balance!,",
          icon: "info",
          html:
            "Click " +
            '<a href="https://vtubiz.com/fundwallet">here</a> ' +
            "to fund your wallet.",
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
        });
      }
    },

    oldbuyData(selectedDate = null, selectedTime = null, SwalContent = null) {
      if (this.transfer_status) {
        if (this.user.pin_status === 0) {
          // If pin_status is 0, proceed directly without prompt
          this.showProcessingAlert(SwalContent || "Purchasing data, please wait...");
          const formData = this.buildFormData(null, selectedDate, selectedTime);
          axios.post("/buydata", formData)
            .then((response) => this.handlePurchaseResponse(response))
            .catch((error) => Swal.fire(error.message));
        } else {
          // Otherwise, prompt for PIN
          this.promptUserPin()
            .then(result => {
              if (result.isConfirmed) {
                this.showProcessingAlert(SwalContent || "Purchasing data, please wait...");
                const formData = this.buildFormData(result.value, selectedDate, selectedTime);
                return axios.post("/buydata", formData);
              }
            })
            .then((response) => {
              if (response) this.handlePurchaseResponse(response);
            })
            .catch((error) => Swal.fire(error.message));
        }
      } else {
        Swal.fire({
          title: "Insufficient balance!",
          icon: "info",
          html: 'Click <a href="https://vtubiz.com/fundwallet">here</a> to fund your wallet.',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
        });
      }
    },

    // Separate function for prompting the user for PIN
    promptUserPin() {
      return Swal.fire({
        title: "Input your four(4) digit pin to proceed",
        icon: "warning",
        input: "password",
        inputAttributes: {
          inputmode: "numeric",
          maxlength: 4,
          autocomplete: "new-password",
          name: "my-pin",
          autocapitalize: "off",
          pattern: "[0-9]*",
          style: "text-align:center;font-size:24px;letter-spacing: 20px",
        },
        showCancelButton: true,
        confirmButtonColor: "#ebab21",
        cancelButtonColor: "grey",
        confirmButtonText: "Buy Data",
        allowOutsideClick: false,
        allowEscapeKey: false,
        inputValidator: (text) => {
          if (!/^\d{4}$/.test(text)) {
            return "Please enter a four-digit PIN";
          }
        },
      });
    },

    // Separate function to handle the processing alert
    showProcessingAlert(message) {
      Swal.fire({
        title: message,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },

    // Separate function to build form data
    buildFormData(pin, selectedDate, selectedTime) {
      let fd = new FormData();
      fd.append("phone_number", this.phone_number);
      fd.append("network", this.network);
      fd.append("plan", this.selectedPlan);
      fd.append("pin", pin || ""); // Use empty string if no pin required
      if (selectedDate) fd.append("selectedDate", selectedDate);
      if (selectedTime) fd.append("selectedTime", selectedTime);
      return fd;
    },

    // Separate function to handle purchase response
    handlePurchaseResponse(response) {
      if (response.data.success === "true") {
        Swal.fire({
          icon: "success",
          title: "Purchase successful!",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok",
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then(() => location.reload());
      } else if (response.data === "schedule_saved") {
        Swal.fire({
          icon: "success",
          title: "Data Purchase Scheduled For Later Successfully!",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok",
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then(() => location.reload());
      } else if (response.data.type === "duplicate") {
        // Handle duplicate response as necessary
        // (you could add here your duplicate handling logic)
      } else {
        Swal.fire({
          icon: "error",
          title: response.data.message,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok",
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
      }
    }

  },
};
</script>

<style></style>