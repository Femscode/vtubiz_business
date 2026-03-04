<template>
  <div class="purchase-page">
    <div class="grid-layout">
      <!-- Main Content Section -->
      <div class="form-section">
        <div class="card main-card border-0 shadow-sm">
          <div class="card-header bg-transparent border-0 pt-8 px-10">
            <div class="d-flex align-items-center justify-content-between">
              <h2 class="font-weight-bolder text-dark mb-0">Electricity Bill</h2>
              <a onclick="window.history.back()" class="btn btn-light-primary btn-sm font-weight-bolder px-6">
                <i class="ki ki-long-arrow-back icon-sm"></i> Back
              </a>
            </div>
            <p class="text-muted mt-2 font-weight-bold">Pay your electricity bills across all discos</p>
          </div>

          <div class="card-body px-10 pb-10">
            <!-- Service Provider Selection -->
            <div class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Select Provider</label>
              <div class="provider-grid scrollable-x pb-4">
                <div 
                  v-for="disco in discos" 
                  :key="disco.id"
                  :class="['provider-card', { active: service_type === disco.id }]"
                  @click="selectProvider(disco.id)"
                >
                  <div class="provider-logo-wrapper">
                    <div class="brand-initials">{{ disco.shortName.charAt(0) }}</div>
                  </div>
                  <span class="provider-short-name">{{ disco.shortName }}</span>
                  <div class="active-badge" v-if="service_type === disco.id">
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Meter Type Selection -->
            <div class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Meter Type</label>
              <div class="row g-4">
                <div class="col-6">
                  <div 
                    :class="['type-card', { active: meter_type === '01' }]"
                    @click="meter_type = '01'; resetValidation()"
                  >
                    <div class="d-flex align-items-center">
                      <div class="type-icon me-4" style="background-color: rgba(46, 204, 113, 0.1); color: #2ecc71; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center">
                        <i class="flaticon2-flash-symbol"></i>
                      </div>
                      <span class="font-weight-bolder font-size-lg">Prepaid</span>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div 
                    :class="['type-card', { active: meter_type === '02' }]"
                    @click="meter_type = '02'; resetValidation()"
                  >
                    <div class="d-flex align-items-center">
                      <div class="type-icon me-4" style="background-color: rgba(251, 145, 41, 0.1); color: #fb9129; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center">
                        <i class="flaticon2-list-1"></i>
                      </div>
                      <span class="font-weight-bolder font-size-lg">Postpaid</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Meter Number Section -->
            <div class="mb-10">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="form-label font-weight-bolder text-dark-75 mb-0">Meter Number</label>
              </div>

              <!-- Beneficiary Quick Select -->
              <div v-if="beneficiaries && beneficiaries.length > 0" class="beneficiary-scroll mb-6">
                <div 
                  v-for="ben in beneficiaries.filter(b => b.type === 'electricity')" 
                  :key="ben.id"
                  class="beneficiary-pill"
                  @click="meter_number = ben.phone; resetValidation();"
                >
                  <div class="ben-avatar">{{ ben.name.charAt(0).toUpperCase() }}</div>
                  <span class="ben-name">{{ ben.name }}</span>
                </div>
              </div>

              <div class="input-group input-group-solid input-group-lg">
                <input 
                  type="number" 
                  class="form-control" 
                  v-model="meter_number" 
                  placeholder="Enter meter number"
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

            <!-- Meter Details Info -->
            <div v-if="show_details" class="alert alert-custom alert-light-success fade show mb-10 py-6 px-8 border-0" role="alert">
              <div class="alert-icon">
                <i class="flaticon2-check-mark text-success"></i>
              </div>
              <div class="alert-text">
                <div class="d-flex flex-column mb-3">
                  <span class="text-dark-75 font-weight-bolder font-size-lg">{{ customer_name }}</span>
                  <span class="text-muted font-weight-bold">{{ customer_address }}</span>
                </div>
                <div v-if="customer_arrears" class="d-flex align-items-center">
                  <span class="label label-light-danger label-inline font-weight-bold py-3">Arrears: {{ customer_arrears }}</span>
                </div>
              </div>
            </div>

            <!-- Amount Input -->
            <div v-if="show_amount" class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Amount to Pay</label>
              <div class="input-group input-group-solid input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text font-weight-bolder" style="background: #f3f6f9; border: none; font-size: 1.2rem">₦</span>
                </div>
                <input 
                  type="number" 
                  class="form-control font-weight-bolder" 
                  v-model="amount" 
                  placeholder="Enter amount (Min 1,000)"
                  style="font-size: 1.2rem"
                />
              </div>
              <span class="form-text text-muted mt-3">Minimum payment is ₦1,000</span>
            </div>

            <!-- Purchased Code Display -->
            <div v-if="showpurchased_code" class="alert alert-custom alert-light-primary fade show mb-10 py-8 px-10 border-dashed border-primary" role="alert">
              <div class="alert-text text-center">
                <div class="text-dark-75 font-weight-bolder font-size-h4 mb-3">Your Token Code</div>
                <div class="bg-white rounded-xl p-6 border text-primary font-weight-bolder font-size-h1 letter-spacing-5 mb-6 shadow-sm">
                  {{ purchased_code }}
                </div>
                <button @click="copyToken" class="btn btn-primary font-weight-bolder px-10 py-3">
                  <i class="flaticon2-copy"></i> Copy Token
                </button>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-12">
              <button 
                v-if="!confirmed" 
                @click="confirmDetail" 
                type="button" 
                class="btn btn-primary btn-lg w-100 font-weight-bolder text-uppercase py-5 shadow-sm btn-hover-scale"
                :disabled="!service_type || !meter_type || !meter_number"
              >
                Validate Meter
              </button>
              <button 
                v-else 
                @click="buyElectricity"
                type="button" 
                class="btn btn-success btn-lg w-100 font-weight-bolder text-uppercase py-5 shadow-sm btn-hover-scale"
                :disabled="!amount || amount < 1000"
              >
                Buy Token
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
                  <span class="text-white opacity-75 font-weight-bold">Provider</span>
                  <span class="font-weight-bolder text-white">{{ selectedDiscoName || '---' }}</span>
                </div>
                
                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Meter Type</span>
                  <span class="font-weight-bolder text-white">{{ meter_type === '01' ? 'Prepaid' : meter_type === '02' ? 'Postpaid' : '---' }}</span>
                </div>

                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Meter No.</span>
                  <span class="font-weight-bolder text-white">{{ meter_number || '---' }}</span>
                </div>

                <div v-if="customer_name" class="summary-item mb-6 d-flex justify-content-between align-items-center border-top border-white border-opacity-10 pt-6">
                  <span class="text-white opacity-75 font-weight-bold">Customer</span>
                  <span class="font-weight-bolder text-end text-white ps-4" style="flex: 1; word-break: break-word;">{{ customer_name }}</span>
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

          <!-- Important Info Card -->
          <div class="card border-0 shadow-sm bg-light-warning border-left border-3 border-warning">
            <div class="card-body p-8">
              <div class="d-flex align-items-center mb-4 text-warning">
                <i class="flaticon-info icon-lg text-warning mr-3"></i>
                <h5 class="mb-0 font-weight-bolder">Important Info</h5>
              </div>
              <ul class="text-dark-50 font-weight-bold font-size-sm mb-0 ps-4 line-height-lg">
                <li class="mb-2">Ensure your meter number is correct before validating.</li>
                <li>Token generation is instant after successful payment.</li>
              </ul>
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
      service_type: "",
      meter_type: "",
      meter_number: "",
      show_details: false,
      customer_name: "",
      customer_address: "",
      customer_arrears: "",
      transfer_status: false,
      confirmed: false,
      amount: "",
      show_amount: false,
      purchased_code: '',
      showpurchased_code: false,
      discos: [
        { id: "01", name: "Eko Electricity - EKEDC", shortName: "EKEDC", logo: "/assets/media/logos/ekedc.png" },
        { id: "02", name: "Ikeja Electricity - IKEDC", shortName: "IKEDC", logo: "/assets/media/logos/ikedc.png" },
        { id: "03", name: "PortHarcourt Electricity - PHEDC", shortName: "PHEDC", logo: "/assets/media/logos/phedc.png" },
        { id: "04", name: "Kaduna Electricity - KAEDC", shortName: "KAEDC", logo: "/assets/media/logos/kaedc.png" },
        { id: "05", name: "Abuja Electricity - AEDC", shortName: "AEDC", logo: "/assets/media/logos/aedc.png" },
        { id: "06", name: "Ibadan Electricity - IBEDC", shortName: "IBEDC", logo: "/assets/media/logos/ibedc.png" },
        { id: "07", name: "Kano Electricity - KEDC", shortName: "KEDC", logo: "/assets/media/logos/kedc.png" },
        { id: "08", name: "Jos Electricity - JEDC", shortName: "JEDC", logo: "/assets/media/logos/jedc.png" },
        { id: "09", name: "Enugu Electricity - EEDC", shortName: "EEDC", logo: "/assets/media/logos/eedc.png" },
        { id: "10", name: "Benin Electricity - BEDC", shortName: "BEDC", logo: "/assets/media/logos/bedc.png" },
      ]
    };
  },
  computed: {
    selectedDiscoName() {
      const disco = this.discos.find(d => d.id === this.service_type);
      return disco ? disco.shortName : "";
    },
    totalAmount() {
      return this.amount ? parseFloat(this.amount).toLocaleString() : "0.00";
    }
  },
  methods: {
    selectProvider(id) {
      this.service_type = id;
      this.resetValidation();
    },
    resetValidation() {
      this.show_details = false;
      this.confirmed = false;
      this.show_amount = false;
      this.customer_name = "";
      this.customer_address = "";
      this.customer_arrears = "";
      this.showpurchased_code = false;
    },
    confirmDetail() {
      if (this.service_type && this.meter_type && this.meter_number.length >= 9) {
        Swal.fire({
          title: "Validating meter number...",
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("service_type", this.service_type);
        fd.append("meter_type", this.meter_type);
        fd.append("meter_number", this.meter_number);
        axios
          .post("fetch_meter_details", fd)
          .then((response) => {
            if (response.data.success == "true") {
              Swal.close();
              this.show_details = true;
              this.confirmed = true;
              this.show_amount = true;
              this.customer_name = response.data.message.content.Customer_Name;
              this.customer_address = response.data.message.content.Address;
              this.customer_arrears = response.data.message.content.Customer_Arrears;
            } else {
              Swal.fire("Error", response.data.message || "Invalid meter number", "error");
            }
          })
          .catch((error) => {
            Swal.fire("Error", "Validation failed. Please try again.", "error");
          });
      } else {
        Swal.fire("Warning", "Please fill all required fields correctly", "warning");
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
            this.meter_number = selectedVal;
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
        if (!this.meter_number) {
          event.target.checked = false;
          Toast.fire({ icon: "warning", title: "Enter meter number first" });
          return;
        }
        Swal.fire({
          title: "Name Of Beneficiary",
          input: "text",
          inputPlaceholder: "e.g. My Apartment",
          showCancelButton: true,
          confirmButtonText: "Save",
        }).then((result) => {
          if (result.isConfirmed && result.value) {
            let fd = new FormData();
            fd.append("phone", this.meter_number);
            fd.append("name", result.value);
            fd.append("type", 'electricity');
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
    buyElectricity() {
      if (this.amount >= 1000 && this.meter_type) {
        Swal.fire({
          title: "Enter Transaction PIN",
          text: `You are paying ₦${this.totalAmount} for electricity`,
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
            fd.append("company", this.service_type);
            fd.append("meter_type", this.meter_type);
            fd.append("meter_number", this.meter_number);
            fd.append("amount", this.amount);
            fd.append("pin", pin);
            
            return axios.post("/buyElectricity", fd)
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
            this.showpurchased_code = true;
            this.purchased_code = result.value.message.purchased_code;
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: "Token generated successfully",
            });
          }
        });
      } else {
        Swal.fire("Warning", "Minimum amount is ₦1,000", "warning");
      }
    },
    copyToken() {
      navigator.clipboard.writeText(this.purchased_code).then(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Token copied!',
          showConfirmButton: false,
          timer: 1500
        });
      });
    }
  },
};
</script>

<style scoped>
.purchase-page {
  padding: 0;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
}

.grid-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 400px;
  gap: 30px;
  align-items: start;
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
  display: flex;
  overflow-x: auto;
  gap: 12px;
  padding: 4px 0;
  -webkit-overflow-scrolling: touch;
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

.provider-grid {
  display: flex !important;
  gap: 20px;
  overflow-x: auto !important;
  flex-wrap: nowrap !important;
  -webkit-overflow-scrolling: touch;
  width: 100%;
}

.provider-card {
  min-width: 120px;
  padding: 20px;
  border: 2px solid #f3f6f9;
  border-radius: 20px;
  cursor: pointer;
  text-align: center;
  transition: all 0.3s ease;
  position: relative;
  background: white;
}

.provider-card:hover {
  border-color: #fb9129;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

.provider-card.active {
  border-color: #fb9129;
  background-color: rgba(251, 145, 41, 0.05);
}

.provider-logo-wrapper {
  width: 60px;
  height: 60px;
  margin: 0 auto 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #001f3f;
  border-radius: 12px;
}

.brand-initials {
  color: #fb9129;
  font-size: 1.8rem;
  font-weight: 800;
  font-family: 'Fraunces', serif;
}

.provider-logo {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.provider-short-name {
  font-size: 0.9rem;
  font-weight: 700;
  color: #3f4254;
}

.active-badge {
  position: absolute;
  top: -10px;
  right: -10px;
  background: #fb9129;
  color: white;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  box-shadow: 0 4px 8px rgba(251, 145, 41, 0.3);
}

.type-card {
  padding: 1.5rem;
  border: 2px solid #f3f6f9;
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.type-card:hover {
  border-color: #fb9129;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.type-card.active {
  border-color: #fb9129;
  background: rgba(251, 145, 41, 0.05);
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

.letter-spacing-5 {
  letter-spacing: 5px;
}

@media (max-width: 1200px) {
  .grid-layout {
    grid-template-columns: 1fr 350px;
  }
}

@media (max-width: 991px) {
  .grid-layout {
    grid-template-columns: 1fr;
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
}
</style>

