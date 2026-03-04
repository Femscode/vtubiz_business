<template>
  <div class="purchase-page">
    <div class="grid-layout">
      <!-- Main Content Section -->
      <div class="form-section">
        <div class="card main-card border-0 shadow-sm">
          <div class="card-header bg-transparent border-0 pt-8 px-10">
            <div class="d-flex align-items-center justify-content-between">
              <h2 class="font-weight-bolder text-dark mb-0">Exam Result Checker</h2>
              <a onclick="window.history.back()" class="btn btn-light-primary btn-sm font-weight-bolder px-6">
                <i class="ki ki-long-arrow-back icon-sm"></i> Back
              </a>
            </div>
            <p class="text-muted mt-2 font-weight-bold">Get WAEC, NECO, JAMB, and NABTEB pins instantly</p>
          </div>

          <div class="card-body px-10 pb-10">
            <!-- Exam Type Selection -->
            <div class="mb-10">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Select Exam Type</label>
              <div class="exam-grid">
                <div 
                  v-for="exam in examinations" 
                  :key="exam.id"
                  :class="['exam-card', { active: selectedExamId === exam.id }]"
                  @click="selectExam(exam)"
                >
                  <div class="exam-icon-wrapper">
                    <div class="brand-initials">{{ exam.exam_type.charAt(0) }}</div>
                  </div>
                  <div class="exam-details">
                    <span class="exam-name">{{ exam.exam_type }}</span>
                    <span class="exam-price text-primary">₦{{ exam.real_amount }}</span>
                  </div>
                  <div class="active-badge" v-if="selectedExamId === exam.id">
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Number of Pins Selection -->
            <div class="mb-10" v-if="selectedExamId">
              <label class="form-label font-weight-bolder text-dark-75 mb-4">Quantity (No. of Pins)</label>
              <div class="quantity-selector d-flex align-items-center bg-light rounded p-2" style="max-width: 200px">
                <button type="button" @click="decrementPins" class="btn btn-icon btn-white btn-sm shadow-sm rounded-circle">
                  <i class="fa fa-minus text-primary"></i>
                </button>
                <div class="flex-grow-1 text-center font-weight-bolder font-size-h4 px-4">
                  {{ no_of_pins }}
                </div>
                <button type="button" @click="incrementPins" class="btn btn-icon btn-white btn-sm shadow-sm rounded-circle">
                  <i class="fa fa-plus text-primary"></i>
                </button>
              </div>
              <span class="form-text text-muted mt-3">Maximum of 10 pins per transaction</span>
            </div>

            <!-- Purchased Token Display -->
            <div v-if="showpurchased_code" class="alert alert-custom alert-light-primary fade show mb-10 py-8 px-10 border-dashed border-primary" role="alert">
              <div class="alert-text">
                <div class="text-center mb-6">
                  <div class="text-dark-75 font-weight-bolder font-size-h4 mb-2">Pin(s) Generated Successfully</div>
                  <div class="text-muted font-weight-bold">Copy and use for your result checking</div>
                </div>
                <div class="bg-white rounded-xl p-6 border text-primary font-weight-bolder font-size-lg text-center mb-6 overflow-auto shadow-sm" style="max-height: 250px">
                  <div v-for="(pin, index) in pinsList" :key="index" class="pin-item py-3 border-bottom border-light">
                    {{ pin }}
                  </div>
                </div>
                <div class="text-center">
                  <button @click="copyAllPins" class="btn btn-primary font-weight-bolder px-10 py-3 shadow-sm">
                    <i class="flaticon2-copy"></i> Copy All Pins
                  </button>
                </div>
              </div>
            </div>

            <!-- Buy Button -->
            <div class="mt-12">
              <button 
                @click="buyExamination"
                type="button" 
                class="btn btn-success btn-lg w-100 font-weight-bolder text-uppercase py-5 shadow-sm btn-hover-scale"
                :disabled="!selectedExamId || !amount"
              >
                Buy Result Checker
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
                  <span class="text-white opacity-75 font-weight-bold">Exam</span>
                  <span class="font-weight-bolder text-end text-white ps-4" style="flex: 1; word-break: break-word;">{{ selectedExamName || '---' }}</span>
                </div>
                
                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Price Per Pin</span>
                  <span class="font-weight-bolder text-white ps-4">₦{{ unitPrice }}</span>
                </div>

                <div class="summary-item mb-6 d-flex justify-content-between align-items-center">
                  <span class="text-white opacity-75 font-weight-bold">Quantity</span>
                  <span class="font-weight-bolder text-white ps-4">{{ no_of_pins }} Pin(s)</span>
                </div>
              </div>

              <div class="total-section mt-8">
                <div class="d-flex justify-content-between align-items-end">
                  <span class="text-white opacity-90 font-weight-bold">Total Amount</span>
                  <h1 class="text-white font-weight-bolder mb-0" style="font-size: 2.2rem">₦{{ formattedTotal }}</h1>
                </div>
              </div>
            </div>
          </div>

          <!-- Helpful Info Card -->
          <div class="card border-0 shadow-sm bg-light-info border-left border-3 border-info">
            <div class="card-body p-8">
              <div class="d-flex align-items-center mb-4 text-info">
                <i class="flaticon-questions-wheel icon-lg text-info mr-3"></i>
                <h5 class="mb-0 font-weight-bolder">How to check?</h5>
              </div>
              <p class="text-dark-50 font-weight-bold font-size-sm mb-0 line-height-lg">
                After purchase, copy the pin and visit the official examination portal to check your results.
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
  props: ["user", "examinations", "company"],
  data() {
    return {
      selectedExamId: null,
      selectedExamName: "",
      unitPrice: 0,
      no_of_pins: 1,
      amount: 0,
      purchased_code: "",
      showpurchased_code: false,
    };
  },
  computed: {
    formattedTotal() {
      return this.amount ? parseFloat(this.amount).toLocaleString() : "0.00";
    },
    pinsList() {
      if (!this.purchased_code) return [];
      return this.purchased_code.split(',').map(p => p.trim());
    }
  },
  methods: {
    getExamLogo(type) {
      const exam = type.toLowerCase();
      if (exam.includes('waec')) return '/assets/media/logos/waec.png';
      if (exam.includes('neco')) return '/assets/media/logos/neco.png';
      if (exam.includes('jamb')) return '/assets/media/logos/jamb.png';
      if (exam.includes('nabteb')) return '/assets/media/logos/nabteb.png';
      return '/assets/media/logos/exam-default.png';
    },
    selectExam(exam) {
      this.selectedExamId = exam.id;
      this.selectedExamName = exam.exam_type;
      this.unitPrice = exam.real_amount;
      this.updateTotal();
    },
    incrementPins() {
      if (this.no_of_pins < 10) {
        this.no_of_pins++;
        this.updateTotal();
      }
    },
    decrementPins() {
      if (this.no_of_pins > 1) {
        this.no_of_pins--;
        this.updateTotal();
      }
    },
    updateTotal() {
      this.amount = this.unitPrice * this.no_of_pins;
    },
    buyExamination() {
      if (!this.amount) return;
      
      Swal.fire({
        title: "Enter Transaction PIN",
        text: `You are paying ₦${this.formattedTotal} for ${this.no_of_pins} ${this.selectedExamName} pin(s)`,
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
          fd.append("exam_type", this.selectedExamName);
          fd.append("no_of_pins", this.no_of_pins);
          fd.append("amount", this.amount);
          fd.append("pin", pin);
          
          return axios.post("/buyExamination", fd)
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
          this.purchased_code = result.value.pin;
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: "Pins generated successfully",
          });
        }
      });
    },
    copyAllPins() {
      navigator.clipboard.writeText(this.purchased_code).then(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'All pins copied!',
          showConfirmButton: false,
          timer: 1500
        });
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

.exam-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 15px;
  width: 100%;
}

.exam-card {
  padding: 20px;
  border: 1px solid #ebedf3;
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.2s ease;
  position: relative;
  background: #fcfcfd;
  display: flex;
  align-items: center;
}

.exam-card:hover {
  border-color: #fb9129;
  background: white;
  transform: translateY(-2px);
}

.exam-card.active {
  border-color: #fb9129;
  background-color: rgba(251, 145, 41, 0.05);
  box-shadow: 0 4px 12px rgba(251, 145, 41, 0.08);
}

.exam-icon-wrapper {
  width: 44px;
  height: 44px;
  margin-right: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #001f3f;
  border-radius: 10px;
  padding: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.03);
}

.brand-initials {
  color: #fb9129;
  font-size: 1.4rem;
  font-weight: 800;
  font-family: 'Fraunces', serif;
}

.exam-logo {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.exam-details {
  display: flex;
  flex-direction: column;
}

.exam-name {
  font-size: 0.95rem;
  font-weight: 700;
  color: #3f4254;
}

.exam-price {
  font-size: 0.9rem;
  font-weight: 600;
  color: #fb9129 !important;
}

.active-badge {
  position: absolute;
  top: -8px;
  right: -8px;
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

.quantity-selector button {
  transition: all 0.2s ease;
}

.quantity-selector button:hover {
  background-color: #fb9129 !important;
  color: white !important;
}

.quantity-selector button:hover i {
  color: white !important;
}

.btn-hover-scale {
  transition: all 0.2s ease-in-out;
}

.btn-hover-scale:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.pin-item {
  font-family: 'Courier New', Courier, monospace;
  letter-spacing: 2px;
  font-weight: 800;
  font-size: 1.2rem;
}

.pin-item:last-child {
  border-bottom: none !important;
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
    
    <style>
</style>