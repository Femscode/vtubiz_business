<template>
  <div class="purchase-page">
    <!-- Purchase Type Toggle -->
    <div class="tabs-container">
      <button 
        @click="purchaseType = 'single'" 
        :class="['tab', { active: purchaseType === 'single' }]"
      >Single Purchase</button>
      <button 
        class="tab disabled"
        disabled
      >Group Purchase <span class="coming-soon">Coming Soon</span></button>
    </div>

    <div class="grid-layout">
      <!-- Main Form Section -->
      <div class="form-section">
        
        <!-- 1. Beneficiary list first -->
        <div class="section-group" v-if="beneficiaries.length > 0">
          <h3 class="section-label">SAVED BENEFICIARIES</h3>
          <div class="beneficiary-scroll">
            <div class="beneficiary-pills-container">
              <div 
                v-for="ben in beneficiaries" 
                :key="ben.id" 
                class="beneficiary-pill"
                @click="useBeneficiary(ben)"
              >
                <div class="b-avatar">{{ ben.name.substring(0,2).toUpperCase() }}</div>
                <span class="b-name">{{ ben.name }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- 2. Network Selection second -->
        <div class="section-group">
          <h3 class="section-label">SELECT NETWORK</h3>
          <div class="input-group">
            <select 
              v-model="network" 
              @change="fetchDiscount"
              class="input-field"
            >
              <option value="">-- Choose Network --</option>
              <option v-for="net in networks" :key="net.id" :value="net.id">
                {{ net.name }}
              </option>
            </select>
          </div>
        </div>

        <!-- 3. Amount Input third -->
        <div class="section-group">
          <h3 class="section-label">AMOUNT</h3>
          <div class="input-group">
            <label class="input-label">Enter Amount (₦)</label>
            <input 
              type="number" 
              v-model="amount" 
              @input="fetchDiscount"
              placeholder="Min ₦50"
              class="input-field"
            >
            <div class="charge-hint" v-if="amount >= 50">
              <i class="fa-solid fa-circle-info me-1"></i> You will be charged: ₦{{ numberFormat(discountedAmount) }}
            </div>
          </div>
        </div>

        <!-- 4. Phone Number fourth -->
        <div class="section-group">
          <h3 class="section-label">RECIPIENT</h3>
          <div class="input-group">
            <label class="input-label">Phone Number</label>
            <input 
              type="tel" 
              v-model="phone_number" 
              @input="fetchNetwork()"
              placeholder="0803 000 0000"
              class="input-field"
            >
          </div>
          
          <div class="save-beneficiary-check">
            <input type="checkbox" id="save-bene" @change="saveBeneficiary">
            <label for="save-bene">Save as beneficiary</label>
          </div>
        </div>
      </div>

      <!-- Summary Sidebar -->
      <div class="summary-column">
        <div class="summary-card">
          <h3 class="section-label">Purchase Summary</h3>
          
          <div class="summary-row">
            <span>Service</span>
            <span class="summary-value">Airtime Top-up</span>
          </div>

          <div class="summary-row">
            <span>Network</span>
            <span class="summary-value">{{ getNetworkName(network) }}</span>
          </div>
          
          <div class="summary-row">
            <span>Amount</span>
            <span class="summary-value">₦{{ numberFormat(amount) }}</span>
          </div>
          
          <div class="summary-row">
            <span>Recipient</span>
            <span class="summary-value">{{ phone_number || '---' }}</span>
          </div>

          <div class="total-section">
            <span class="total-label">Total Pay</span>
            <span class="total-amount">₦{{ numberFormat(discountedAmount) }}</span>
          </div>

          <button 
            class="btn-primary" 
            :disabled="!isReady"
            @click="buyAirtime()"
          >
            Buy Now
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </button>
          
         
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
      purchaseType: 'single',
      phone_number: "",
      network: "",
      amount: "",
      ben_name: "",
      discountedAmount: 0,
      transfer_status: false,
      networks: [
        { id: "1", name: "MTN" },
        { id: "2", name: "GLO" },
        { id: "3", name: "Airtel" },
        { id: "4", name: "9Mobile" }
      ]
    };
  },
  computed: {
    isReady() {
      return this.network && this.amount >= 50 && this.phone_number.length >= 10;
    }
  },
  methods: {
    useBeneficiary(ben) {
      this.phone_number = ben.phone;
      this.fetchNetwork();
    },
    getNetworkName(id) {
      const net = this.networks.find(n => n.id == id);
      return net ? net.name : '---';
    },
    numberFormat(val) {
      return new Intl.NumberFormat().format(val || 0);
    },
    fetchNetwork() {
      if (this.phone_number.length >= 10 && this.phone_number.length <= 12) {
        axios.get("/fetchnetwork/" + this.phone_number)
          .then((response) => {
            if (response.data !== 0) {
              this.network = response.data;
              this.fetchDiscount();
              this.transfer_status = true;
            }
          });
      } else {
        this.network = null;
        this.transfer_status = false;
      }
    },
    fetchDiscount() {
      if (this.amount >= 50 && this.network) {
        axios.get("/fetch_airtime_rate/" + this.network + "/" + this.user.company_id)
          .then((response) => {
            var rate = response.data;
            this.discountedAmount = this.amount - (parseFloat(rate) / 100) * this.amount;
          });
      } else {
        this.discountedAmount = this.amount;
      }
    },
    buyAirtime() {
      if (!this.isReady) return;
      
      Swal.fire({
        title: "Confirm Purchase",
        text: `You are about to buy ₦${this.numberFormat(this.amount)} airtime for ${this.phone_number}. Enter PIN to proceed.`,
        icon: "warning",
        input: "password",
        inputAttributes: {
          inputmode: "numeric",
          maxlength: 4,
          style: "text-align:center;font-size:24px;letter-spacing: 20px",
        },
        showCancelButton: true,
        confirmButtonColor: "#0F3548",
        confirmButtonText: "Buy Now",
        inputValidator: (text) => {
          if (!/^\d{4}$/.test(text)) return "Please enter a 4-digit PIN";
        },
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({ title: "Processing...", didOpen: () => { Swal.showLoading(); } });
          
          let fd = new FormData();
          fd.append("phone_number", this.phone_number);
          fd.append("network", this.network);
          fd.append("amount", this.amount);
          fd.append("discounted_amount", this.discountedAmount);
          fd.append("pin", result.value);

          axios.post("/buyairtime", fd).then((response) => {
            if (response.data.success == "true") {
              Swal.fire("Success", "Airtime purchase successful!", "success").then(() => location.reload());
            } else {
              Swal.fire("Error", response.data.message, "error");
            }
          }).catch(err => Swal.fire("Error", err.message, "error"));
        }
      });
    },
    saveBeneficiary(event) {
      if (event.target.checked && this.phone_number.length >= 10) {
        Swal.fire({
          title: "Beneficiary Name",
          input: "text",
          inputPlaceholder: "e.g. My Second Line",
          showCancelButton: true,
        }).then(result => {
          if (result.isConfirmed && result.value) {
            let fd = new FormData();
            fd.append("phone", this.phone_number);
            fd.append("name", result.value);
            axios.post("/saveBeneficiary", fd).then(res => {
              if (res.data.success) Swal.fire("Saved!", "", "success");
            });
          }
        });
      }
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.purchase-page {
  --c-text-main: #0F172A;
  --c-text-sec: #64748B;
  --c-border: #E2E8F0;
  --c-orange: #E85D04; 
  --c-orange-light: #FFF1EB;
  --c-green: #00BFA5; 
  --c-green-light: #E0F2F1;
  --c-yellow: #F7DC6F; 
  --c-yellow-light: #FEF9E7;
  --c-purple: #7D79D0; 
  --c-purple-light: #EEEDF9;
  --r-pill: 999px;
  --r-card: 24px;
  --r-input: 16px;
  
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--c-text-main);
  padding: 0;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
  overflow-x: hidden;
}

.tabs-container {
  background: white;
  padding: 6px;
  border-radius: var(--r-pill);
  display: inline-flex;
  border: 1px solid var(--c-border);
  margin-bottom: 32px;
}

.tab {
  padding: 10px 24px;
  border-radius: var(--r-pill);
  border: none;
  background: transparent;
  font-weight: 600;
  font-size: 14px;
  color: var(--c-text-sec);
  cursor: pointer;
  transition: all 0.2s;
}

.tab.active {
  background: var(--c-text-main);
  color: white;
}

.tab.disabled {
  opacity: 0.6;
  cursor: not-allowed;
  display: flex;
  align-items: center;
  gap: 6px;
}

.coming-soon {
  font-size: 10px;
  background: var(--c-orange-light);
  color: var(--c-orange);
  padding: 2px 6px;
  border-radius: 4px;
  font-weight: 700;
  text-transform: uppercase;
}

.grid-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 400px;
  gap: 40px;
  align-items: start;
  width: 100%;
}

.form-section {
  min-width: 0;
}

.summary-column {
  width: 400px;
}

.section-label {
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--c-text-sec);
  font-weight: 700;
  margin-bottom: 16px;
}

.input-label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: var(--c-text-main); }

.beneficiary-section { margin-bottom: 20px; }
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
  gap: 10px;
  padding: 8px 16px 8px 8px;
  background: white;
  border: 1px solid var(--c-border);
  border-radius: var(--r-pill);
  cursor: pointer;
  flex-shrink: 0;
  transition: all 0.2s;
}

.beneficiary-pill:hover { border-color: #5DADE2; transform: translateY(-1px); }
.b-avatar {
  width: 28px;
  height: 28px;
  background: #F1F5F9;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  font-weight: 700;
  color: var(--c-text-sec);
}
.b-name { font-size: 13px; font-weight: 600; }

.input-field {
  width: 100%;
  padding: 16px 20px;
  font-size: 16px;
  border: 1px solid var(--c-border);
  border-radius: var(--r-input);
  background: white;
  transition: border-color 0.2s;
  font-weight: 500;
  color: var(--c-text-main);
}
.input-field:focus { outline: none; border-color: var(--c-orange); }

.charge-hint {
  font-size: 0.85rem;
  color: #27AE60;
  margin-top: 10px;
  font-weight: 600;
}

.save-beneficiary-check {
  margin-top: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.save-beneficiary-check input { accent-color: var(--c-orange); width: 16px; height: 16px; }
.save-beneficiary-check label { font-size: 14px; font-weight: 500; color: var(--c-text-sec); cursor: pointer; }

#app .summary-card {
  background: #001f3f !important;
  color: white !important;
  padding: 32px;
  border-radius: 32px;
  position: sticky;
  top: 40px;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 16px;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.7);
}
.summary-value { font-weight: 700; color: #fff; }

.total-section {
  background: rgba(251, 145, 41, 0.1);
  padding: 24px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.total-label {
  font-size: 14px;
  font-weight: 700;
  color: #fb9129;
}

.total-amount {
  font-size: 28px;
  font-weight: 800;
  color: #fb9129;
}

.btn-primary {
  width: 100%;
  padding: 18px;
  background: var(--c-orange);
  color: white;
  border: none;
  border-radius: var(--r-pill);
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  transition: transform 0.1s, background-color 0.2s;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}
.btn-primary:hover:not(:disabled) { background-color: #D35400; transform: scale(1.02); }
.btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }

.secure-text { text-align: center; margin-top: 16px; font-size: 12px; color: var(--c-text-sec); }

@media (max-width: 1024px) {
  .grid-layout { 
    grid-template-columns: 100%; 
    gap: 20px;
  }
  .summary-column {
    width: 100%;
    order: 1; /* Show summary at bottom on mobile */
  }
  .summary-card {
    position: relative;
    top: 0;
    margin-bottom: 30px;
  }
}

@media (max-width: 600px) {
  .tabs-container {
    display: flex;
    width: 100%;
    overflow-x: auto;
  }
  .tab {
    flex: 1;
    white-space: nowrap;
    padding: 10px 15px;
  }
  .purchase-page {
    padding: 0;
  }
  .summary-card, .form-section {
    padding: 15px;
  }
}
</style>
