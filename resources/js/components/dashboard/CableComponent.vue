<template>
  <div class="purchase-page">
    <div class="grid-layout">
      <!-- Main Content Section -->
      <div class="form-section">
        <div class="card main-card border-0 shadow-sm">
          <div class="card-header bg-transparent border-0 pt-8 px-md-10 px-4">
            <div class="d-flex align-items-center justify-content-between">
              <h2 class="font-weight-bolder text-dark mb-0">Cable Subscription</h2>
              <a onclick="window.history.back()" class="btn btn-light-primary btn-sm font-weight-bolder px-6 d-none d-md-inline-block">
                <i class="ki ki-long-arrow-back icon-sm"></i> Back
              </a>
            </div>
            <p class="text-muted mt-2 font-weight-bold">Pay for your TV subscriptions instantly</p>
          </div>

          <div class="card-body px-md-10 px-4 pb-10">
            <!-- Beneficiary Quick Select -->
            <div v-if="beneficiaries && beneficiaries.length > 0" class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Select Beneficiary</label>
              <div class="beneficiary-scroll">
                <div class="beneficiary-pills-container">
                  <div 
                    v-for="ben in beneficiaries.filter(b => b.type === 'cable')" 
                    :key="ben.id"
                    class="beneficiary-pill"
                    @click="decoder_number = ben.phone; resetValidation();"
                  >
                    <div class="ben-avatar">{{ ben.name.charAt(0).toUpperCase() }}</div>
                    <span class="ben-name">{{ ben.name }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Cable Type Selection -->
            <div class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Select Cable Type</label>
              <select v-model="cable_type" @change="fetchPlan" class="form-control form-control-solid form-control-lg">
                <option value="">-- Select Provider --</option>
                <option v-for="type in cableTypes" :key="type.id" :value="type.id">{{ type.name }}</option>
              </select>
            </div>

            <!-- Package Selection -->
            <div v-if="cable_type" class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Select Package</label>
              <select v-model="selectedPlanId" @change="handlePlanSelect" class="form-control form-control-solid form-control-lg">
                <option value="null">-- Select Plan --</option>
                <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                  {{ plan.plan_name }} (₦{{ plan.admin_price }})
                </option>
              </select>
            </div>

            <!-- Decoder Number Section -->
            <div class="mb-10">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="form-label font-weight-bolder text-dark-75 mb-0">Decoder Number</label>
              </div>

              <div class="input-group input-group-solid input-group-lg">
                <input 
                  type="number" 
                  class="form-control" 
                  v-model="decoder_number" 
                  placeholder="Enter decoder/smartcard number"
                  @input="resetValidation"
                />
              </div>
              
              <div class="mt-4 d-flex align-items-center">
                <div class="checkbox-inline">
                  <label class="checkbox checkbox-outline checkbox-success text-muted font-weight-bold">
                    <input type="checkbox" id="save_ben" @change="saveBeneficiary" />
                    <span></span>
                    <small id="alr_saved">Save as beneficiary</small>
                  </label>
                </div>
              </div>
            </div>

            <!-- Decoder Info Alert -->
            <div v-if="show_decoder" class="alert alert-custom alert-light-primary fade show mb-10 py-6 px-8 border-0" role="alert">
              <div class="alert-icon">
                <i class="flaticon2-information text-primary"></i>
              </div>
              <div class="alert-text d-flex flex-wrap justify-content-between align-items-center">
                <div class="me-4">
                  <div class="text-dark-75 font-weight-bolder font-size-lg">{{ customer_name }}</div>
                  <div class="text-muted font-weight-bold">Current Plan: <span class="text-primary">{{ current_plan }}</span> ({{ plan_status }})</div>
                </div>
                <span class="label label-light-primary label-inline font-weight-bold py-3 px-4">Validated</span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-12">
              <button 
                v-if="showConfirm" 
                @click="confirmDecoder" 
                type="button" 
                class="btn btn-primary btn-lg w-100 font-weight-bolder text-uppercase py-5 shadow-sm btn-hover-scale"
                :disabled="!cable_type || !decoder_number"
              >
                Validate Decoder
              </button>
              <button 
                v-else 
                @click="buyCable"
                type="button" 
                class="btn btn-success btn-lg w-100 font-weight-bolder text-uppercase py-5 shadow-sm btn-hover-scale"
                :disabled="!selectedPlanId"
              >
                Proceed to Pay
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Summary Sidebar Section -->
      <div class="summary-section">
        <div class="sticky-summary">
          <div class="card summary-card border-0 shadow-lg mb-6">
            <div class="card-body p-8">
              <h3 class="font-weight-bolder mb-8 text-white opacity-95">Purchase Summary</h3>
              
              <div class="summary-items">
                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Service</span>
                  <span class="font-weight-bolder text-white">Cable TV</span>
                </div>
                
                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Type</span>
                  <span class="font-weight-bolder text-white">{{ selectedCableName || '---' }}</span>
                </div>

                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Decoder No.</span>
                  <span class="font-weight-bolder text-white">{{ decoder_number || '---' }}</span>
                </div>

                <div v-if="customer_name" class="summary-item mb-6 d-flex justify-content-between align-items-center border-top border-white border-opacity-10 pt-6">
                  <span class="text-white opacity-75 font-weight-bold">Customer</span>
                  <span class="font-weight-bolder text-end text-white ps-4" style="flex: 1; word-break: break-word;">{{ customer_name }}</span>
                </div>

                <div v-if="selectedPlanName" class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Package</span>
                  <span class="font-weight-bolder text-end text-white ps-4" style="flex: 1; word-break: break-word;">{{ selectedPlanName }}</span>
                </div>
              </div>

              <div class="total-section mt-8">
                <div class="d-flex justify-content-between align-items-end">
                  <span class="text-white opacity-90 font-weight-bold">Total Amount</span>
                  <h1 class="text-white font-weight-bolder mb-0" style="font-size: 2.2rem">₦{{ totalAmount }}</h1>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Tip Card -->
          <div class="card border-0 shadow-sm bg-light-info border-left border-3 border-info">
            <div class="card-body p-8">
              <div class="d-flex align-items-center mb-4 text-info">
                <i class="flaticon-light icon-lg text-info mr-3"></i>
                <h5 class="mb-0 font-weight-bolder">Quick Tip</h5>
              </div>
              <p class="text-dark-50 font-weight-bold font-size-sm mb-0 line-height-lg">
                Ensure your decoder is switched on while making payment to allow for instant reconnection.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user", "beneficiaries"],
  data() {
    return {
      cable_type: "",
      customer_name: "",
      current_plan: "",
      plan_status: "",
      showConfirm: true,
      due_date: "",
      decoder_number: "",
      transfer_status: false,
      showPlan: false,
      show_decoder: false,
      selectedPlan: null,
      selectedPlanId: null,
      selectedPlanName: "",
      amount: 0,
      plans: [],
      cableTypes: [
        { id: "01", name: "DSTV", logo: "/assets/media/logos/dstv.png" },
        { id: "02", name: "GOTV", logo: "/assets/media/logos/gotv.png" },
        { id: "03", name: "STARTIMES", logo: "/assets/media/logos/startimes.png" },
      ]
    };
  },
  computed: {
    selectedCableName() {
      const cable = this.cableTypes.find(t => t.id === this.cable_type);
      return cable ? cable.name : "";
    },
    totalAmount() {
      return this.amount ? parseFloat(this.amount).toLocaleString() : "0.00";
    }
  },
  methods: {
    handlePlanSelect(event) {
      const planId = event.target.value;
      const selected = this.plans.find(p => p.id == planId);
      if (selected) {
        this.selectPlan(selected);
      }
    },
    selectPlan(plan) {
      this.selectedPlanId = plan.id;
      this.selectedPlan = plan.plan_id;
      this.selectedPlanName = plan.plan_name;
      this.amount = plan.admin_price;
    },
    resetValidation() {
      this.show_decoder = false;
      this.showConfirm = true;
      this.customer_name = "";
      this.selectedPlanId = null;
      this.selectedPlan = null;
      this.selectedPlanName = "";
      this.amount = 0;
    },
    fetchPlan() {
      if (!this.cable_type) return;
      axios
        .get("fetch_cable_plan/" + this.cable_type)
        .then((response) => {
          this.plans = response.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    confirmDecoder() {
      if (this.cable_type !== "" && this.decoder_number.length >= 10) {
        Swal.fire({
          title: "Fetching decoder details...",
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("cable_type", this.cable_type);
        fd.append("decoder_number", this.decoder_number);
        axios
          .post("fetch_decoder_details", fd)
          .then((response) => {
            if (response.data.success == "true") {
              Swal.close();
              this.show_decoder = true;
              this.showConfirm = false;
              this.customer_name = response.data.message.content.Customer_Name;
              this.current_plan = response.data.message.content.Current_Bouquet;
              this.plan_status = response.data.message.content.Status;
              this.due_date = response.data.message.content.Due_Date;
              this.transfer_status = true;
              this.fetchPlan();
            } else {
              Swal.fire({
                icon: "error",
                title: "Invalid Decoder",
                text: response.data.message || "Could not validate decoder number"
              });
            }
          })
          .catch((error) => {
            Swal.fire("Error", "Validation failed. Please try again.", "error");
          });
      } else {
        Swal.fire("Error", "Please select cable type and enter valid decoder number", "warning");
      }
    },
    selectFromBeneficiary() {
      if (!this.beneficiaries || this.beneficiaries.length === 0) {
        Swal.fire("Info", "No beneficiaries found", "info");
        return;
      }
      const options = this.beneficiaries
        .map((beneficiary) => {
          return `<option value="${beneficiary.phone}">${beneficiary.name} (${beneficiary.phone})</option>`;
        })
        .join("");
      Swal.fire({
        title: "Choose Beneficiary",
        html: `<select class='form-control form-control-solid' id='beneficiary_choice'><option value="">--Select--</option>${options}</select>`,
        showCancelButton: true,
        confirmButtonText: "Select",
      }).then((result) => {
        if (result.isConfirmed) {
          const selectedVal = $("#beneficiary_choice").val();
          if (selectedVal) {
            this.decoder_number = selectedVal;
            this.resetValidation();
            $("#save_ben").prop("checked", true);
          }
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
      });

      if (event.target.checked) {
        if (!this.decoder_number) {
          event.target.checked = false;
          Toast.fire({ icon: "warning", title: "Enter decoder number first" });
          return;
        }
        Swal.fire({
          title: "Name Of Beneficiary",
          input: "text",
          inputPlaceholder: "e.g. Home Decoder",
          showCancelButton: true,
          confirmButtonText: "Save",
        }).then((result) => {
          if (result.isConfirmed && result.value) {
            let fd = new FormData();
            fd.append("phone", this.decoder_number);
            fd.append("name", result.value);
            fd.append("type", 'cable');
            axios.post("/saveBeneficiary", fd)
              .then((response) => {
                if (response.data.success == true) {
                  Toast.fire({ icon: "success", title: "Beneficiary Saved!" });
                  $("#alr_saved").text("Saved as beneficiary");
                } else {
                  Toast.fire({ icon: "info", title: "Already exists" });
                }
              });
          } else {
            event.target.checked = false;
          }
        });
      }
    },
    buyCable() {
      if (!this.transfer_status) return;
      
      Swal.fire({
        title: "Enter Transaction PIN",
        text: `You are paying ₦${this.totalAmount} for ${this.selectedPlanName}`,
        input: "password",
        inputAttributes: {
          inputmode: "numeric",
          maxlength: 4,
          style: "text-align:center;font-size:24px;letter-spacing: 15px",
        },
        showCancelButton: true,
        confirmButtonText: "Pay Now",
        showLoaderOnConfirm: true,
        preConfirm: (pin) => {
          if (!/^\d{4}$/.test(pin)) {
            Swal.showValidationMessage("Please enter a 4-digit PIN");
            return false;
          }
          let fd = new FormData();
          fd.append("cable_type", this.cable_type);
          fd.append("plan", this.selectedPlan);
          fd.append("decoder_number", this.decoder_number);
          fd.append("pin", pin);
          
          return axios.post("/buyCable", fd)
            .then(response => {
              if (response.data.success !== "true") {
                throw new Error(response.data.message || "Transaction failed");
              }
              return response.data;
            })
            .catch(error => {
              Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: "Subscription successful",
          }).then(() => location.reload());
        }
      });
    }
  }
};
</script>

<style scoped>
.purchase-page {
  padding: 0;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
  overflow-x: hidden;
}

.grid-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 400px;
  gap: 30px;
  align-items: start;
  width: 100%;
}

@media (min-width: 1400px) {
  .grid-layout {
    grid-template-columns: minmax(0, 1fr) 450px;
    gap: 40px;
  }
}

.main-card {
  border-radius: 24px;
  overflow: hidden;
}

#app .summary-card {
  background: #001f3f !important;
  color: white !important;
  border-radius: 24px;
}

.sticky-summary {
  position: sticky;
  top: 20px;
}

.beneficiary-scroll {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  margin-bottom: 1rem;
}

.beneficiary-pills-container {
  display: inline-flex;
  gap: 12px;
  padding: 4px 0;
  min-width: 100%;
}

.beneficiary-pill {
  display: flex;
  align-items: center;
  background: white;
  padding: 8px 18px;
  border-radius: 50px;
  border: 1px solid #ebedf3;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.2s;
}

.beneficiary-pill:hover {
  border-color: #fb9129;
  background-color: rgba(251, 145, 41, 0.05);
}

.ben-avatar {
  width: 28px;
  height: 28px;
  background: #fb9129;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 700;
  margin-right: 10px;
}

.ben-name {
  font-size: 13px;
  font-weight: 600;
  color: #3f4254;
}


.btn-hover-scale {
  transition: all 0.2s ease-in-out;
}

.btn-hover-scale:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.scrollable-x::-webkit-scrollbar {
  height: 5px;
}

.scrollable-x::-webkit-scrollbar-thumb {
  background: #e4e6ef;
  border-radius: 10px;
}

.scrollable-y::-webkit-scrollbar {
  width: 5px;
}

.scrollable-y::-webkit-scrollbar-thumb {
  background: #e4e6ef;
  border-radius: 10px;
}

@media (max-width: 991px) {
  .grid-layout {
    grid-template-columns: 100%;
    gap: 20px;
  }
  .summary-section {
    order: 2;
  }
  .form-section {
    order: 1;
  }
  .sticky-summary {
    position: static;
  }
  .card-body {
    padding: 1.5rem !important;
  }
  .main-card {
    border-radius: 16px;
  }
}
</style>