<template>
  <div class="purchase-page">
    <!-- Purchase Type Toggle -->
    <div class="tabs-container">
      <button 
        @click="purchaseType = 'single'" 
        :class="['tab', { active: purchaseType === 'single' }]"
      >Single Purchase</button>
      <button 
        @click="purchaseType = 'group'" 
        :class="['tab', { active: purchaseType === 'group' }]"
      >Group Purchase</button>
    </div>

    <div class="grid-layout">
      <!-- Main Form Section -->
      <div class="form-section">
        
        <!-- Single Purchase Flow -->
        <div v-if="purchaseType === 'single'">
          
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

          <!-- 2. Network select field second -->
          <div class="section-group">
            <h3 class="section-label">SELECT NETWORK</h3>
            <div class="input-group">
              <select 
                v-model="network" 
                @change="fetchPlan()"
                class="input-field"
              >
                <option value="">-- Choose Network --</option>
                <option v-for="net in networks" :key="net.id" :value="net.id">
                  {{ net.name }}
                </option>
              </select>
            </div>
          </div>

          <!-- 3. Plan select field third -->
          <div class="section-group" v-if="network">
            <h3 class="section-label">SELECT PLAN</h3>
            <div class="input-group">
              <select 
                v-model="selectedPlan" 
                class="input-field"
                :disabled="plans.length === 0"
              >
                <option value="">-- Choose Plan --</option>
                <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                  {{ plan.plan_name }} (₦{{ numberFormat(plan.admin_price) }})
                </option>
              </select>
            </div>
          </div>

          <!-- 4. Phone number fourth -->
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

        <!-- Group Recipients (Group Purchase) -->
        <div class="section-group" v-if="purchaseType === 'group'">
          <h3 class="section-label">MULTI-NETWORK RECIPIENTS</h3>
          <div class="recipient-list-scroll">
            <div class="recipient-list">
              <div class="recipient-header d-none d-md-grid">
                <div>PHONE NUMBER</div>
                <div>NETWORK</div>
                <div>SELECT PLAN</div>
                <div></div>
              </div>
              <div v-for="(rec, index) in groupRecipients" :key="index" class="recipient-row stacked-mobile">
                <div class="mobile-label d-md-none">RECIPIENT {{ index + 1 }}</div>
                <div class="input-wrapper">
                  <span class="field-icon d-md-none">📱</span>
                  <input 
                    type="tel" 
                    v-model="rec.phone" 
                    class="table-input" 
                    placeholder="Phone Number"
                    @input="autoDetectNetworkForRow(index)"
                  >
                </div>
                <div class="input-wrapper">
                  <span class="field-icon d-md-none">🌐</span>
                  <select v-model="rec.network_id" class="table-select" @change="fetchPlansForRow(index)">
                    <option value="">Network</option>
                    <option v-for="net in networks" :key="net.id" :value="net.id">{{ net.name }}</option>
                  </select>
                </div>
                <div class="input-wrapper">
                  <span class="field-icon d-md-none">📦</span>
                  <select v-model="rec.plan_id" class="table-select" :disabled="!rec.network_id">
                    <option value="">-- Select Plan --</option>
                    <option v-for="plan in (cachedPlans[rec.network_id] || [])" :key="plan.id" :value="plan.id">
                      {{ plan.plan_name }} (₦{{ numberFormat(plan.admin_price) }})
                    </option>
                  </select>
                </div>
                <div @click="removeRecipient(index)" class="remove-icon">
                  <span class="d-md-none mr-2">Remove Recipient</span> ×
                </div>
              </div>
            </div>
          </div>
          <button @click="addRecipient" class="add-row-btn">+ Add another recipient</button>
        </div>
      </div>

      <!-- Summary Sidebar -->
      <div class="summary-column">
        <div class="summary-card">
          <h3 class="section-label">Purchase Summary</h3>
          
          <div class="summary-row">
            <span>Network</span>
            <span class="summary-value">{{ getNetworkName(network) }}</span>
          </div>
          
          <div class="summary-row">
            <span>Plan</span>
            <span class="summary-value">{{ getSelectedPlanName() }}</span>
          </div>
          
          <div class="summary-row">
            <span>Recipient</span>
            <span class="summary-value">{{ phone_number || '---' }}</span>
          </div>

          <div class="total-section">
            <span class="total-label">Total Pay</span>
            <span class="total-amount">₦{{ numberFormat(calculateTotal()) }}</span>
          </div>

          <button 
            class="btn-primary" 
            :disabled="!isReady"
            @click="buyData()"
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
  props: ["user", "company", "beneficiaries"],
  data() {
    return {
      purchaseType: 'single',
      phone_number: "",
      network: "",
      selectedPlan: "",
      plans: [],
      cachedPlans: {},
      ben_name: "",
      transfer_status: false,
      groupRecipients: [{ phone: '', network_id: '', plan_id: '' }],
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
      if (this.purchaseType === 'single') {
        return this.network && this.selectedPlan && this.phone_number.length >= 10;
      }
      return this.groupRecipients.length > 0 && 
             this.groupRecipients.every(r => r.phone.length >= 10 && r.network_id && r.plan_id);
    }
  },
  methods: {
    autoDetectNetworkForRow(index) {
      const rec = this.groupRecipients[index];
      if (rec.phone.length >= 10 && rec.phone.length <= 12) {
        axios.get("/fetchnetwork/" + rec.phone)
          .then((response) => {
            if (response.data !== 0) {
              rec.network_id = response.data.toString();
              this.fetchPlansForRow(index);
            }
          });
      }
    },
    fetchPlansForRow(index) {
      const netId = this.groupRecipients[index].network_id;
      if (netId && !this.cachedPlans[netId]) {
        axios.get("/fetchplan/" + netId)
          .then((response) => {
            if (response.data !== false) {
              this.$set(this.cachedPlans, netId, response.data);
            }
          });
      }
    },
    useBeneficiary(ben) {
      this.phone_number = ben.phone;
      this.fetchNetwork();
    },
    getNetworkName(id) {
      const net = this.networks.find(n => n.id == id);
      return net ? net.name : '---';
    },
    getPlanName(id, netId = null) {
      if (!id) return '';
      const plans = netId ? (this.cachedPlans[netId] || []) : this.plans;
      const plan = plans.find(p => p.id == id);
      return plan ? plan.plan_name : '';
    },
    getSelectedPlanName() {
      if (this.purchaseType === 'single') {
        const plan = this.plans.find(p => p.id == this.selectedPlan);
        return plan ? plan.plan_name : '---';
      }
      const selectedCount = this.groupRecipients.filter(r => r.plan_id).length;
      return `${selectedCount} Item(s) in Group`;
    },
    calculateTotal() {
      if (this.purchaseType === 'single') {
        const plan = this.plans.find(p => p.id == this.selectedPlan);
        return plan ? Number(plan.admin_price) : 0;
      } else {
        return this.groupRecipients.reduce((total, r) => {
          if (!r.network_id || !r.plan_id) return total;
          const plans = this.cachedPlans[r.network_id] || [];
          const plan = plans.find(p => p.id == r.plan_id);
          return total + (plan ? Number(plan.admin_price) : 0);
        }, 0);
      }
    },
    numberFormat(val) {
      return new Intl.NumberFormat().format(val || 0);
    },
    addRecipient() {
      this.groupRecipients.push({ phone: '', network_id: '', plan_id: '' });
    },
    removeRecipient(index) {
      if (this.groupRecipients.length > 1) {
        this.groupRecipients.splice(index, 1);
      } else {
        this.groupRecipients[0].phone = '';
        this.groupRecipients[0].network_id = '';
        this.groupRecipients[0].plan_id = '';
      }
    },
    fetchNetwork() {
      if (this.phone_number.length >= 10 && this.phone_number.length <= 12) {
        axios.get("/fetchnetwork/" + this.phone_number)
          .then((response) => {
            if (response.data !== 0) {
              this.network = response.data;
              this.fetchPlan();
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
          });
      } else {
        this.selectedPlan = null;
        this.plans = [];
        this.network = null;
        this.transfer_status = false;
      }
    },
    fetchPlan() {
      if (this.network) {
        this.selectedPlan = ""; // Reset selected plan on network change
        axios.get("/fetchplan/" + this.network)
          .then((response) => {
            if (response.data !== false) {
              this.plans = response.data;
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
          });
      } else {
        this.plans = [];
        this.selectedPlan = "";
      }
    },
    buyData() {
      if (!this.isReady) return;
      
      const totalAmount = this.calculateTotal();
      const planName = this.getSelectedPlanName();
      const recipientsCount = this.purchaseType === 'single' ? 1 : this.groupRecipients.length;
      
      Swal.fire({
        title: "Confirm Purchase",
        text: this.purchaseType === 'single' 
          ? `You are about to buy ${planName} for ${this.phone_number}. Total: ₦${this.numberFormat(totalAmount)}. Enter PIN to proceed.`
          : `You are about to buy ${this.getSelectedPlanName()} for ${recipientsCount} recipients. Total: ₦${this.numberFormat(totalAmount)}. Enter PIN to proceed.`,
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
          
          if (this.purchaseType === 'single') {
            const actualPlan = this.plans.find(p => p.id == this.selectedPlan);
            fd.append("network", this.network);
            fd.append("plan", actualPlan ? actualPlan.plan_id : this.selectedPlan);
            fd.append("phone_number", this.phone_number);
          } else {
            const recipientsWithDetails = this.groupRecipients.map(r => {
              const plans = this.cachedPlans[r.network_id] || [];
              const actualPlan = plans.find(p => p.id == r.plan_id);
              return {
                phone: r.phone,
                network: r.network_id,
                plan: actualPlan ? actualPlan.plan_id : r.plan_id
              };
            });
            fd.append("recipients", JSON.stringify(recipientsWithDetails));
          }
          
          fd.append("pin", result.value);
          fd.append("purchase_type", this.purchaseType);

          const endpoint = this.purchaseType === 'single' ? "/buydata" : "/bulk_buydata";

          axios.post(endpoint, fd).then((response) => {
            if (response.data.success == "true" || response.data.status == "success") {
              Swal.fire("Success", response.data.message || "Purchase successful!", "success").then(() => location.reload());
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
          inputPlaceholder: "e.g. My Main Sim",
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
  padding: 0;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
  overflow-x: hidden;
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
  background: rgba(251, 145, 41, 0.1);
  color: #fb9129;
  font-size: 10px;
  font-weight: 800;
  padding: 4px 10px;
  border-radius: 50px;
  margin-left: 8px;
}

.grid-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 400px;
  gap: 40px;
  align-items: start;
  width: 100%;
}

.form-section {
  min-width: 0; /* Allow the form section to shrink correctly if needed */
}

.summary-column {
  width: 380px;
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

.save-beneficiary-check {
  margin-top: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.save-beneficiary-check input { accent-color: var(--c-orange); width: 16px; height: 16px; }
.save-beneficiary-check label { font-size: 14px; font-weight: 500; color: var(--c-text-sec); cursor: pointer; }

.recipient-list-scroll {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid var(--c-border);
  border-radius: 20px;
  background: white;
}

.recipient-list { overflow: hidden; }
.recipient-header {
  display: grid;
  grid-template-columns: 2fr 1fr 40px;
  gap: 16px;
  padding: 12px 24px;
  background: #F8FAFC;
  font-size: 12px;
  font-weight: 700;
  color: var(--c-text-sec);
}

.recipient-row {
  display: grid;
  grid-template-columns: 2fr 1fr 2fr 40px;
  gap: 16px;
  padding: 16px 24px;
  border-bottom: 1px solid var(--c-border);
  align-items: center;
}
.recipient-row:last-child { border-bottom: none; }

.input-wrapper {
  display: flex;
  align-items: center;
  gap: 8px;
  width: 100%;
}

.mobile-label {
  font-size: 11px;
  font-weight: 800;
  color: var(--c-orange);
  letter-spacing: 0.05em;
  margin-bottom: 4px;
}

.field-icon {
  font-size: 14px;
  width: 24px;
  text-align: center;
}

.table-input { border:none; background:transparent; font-weight:600; font-size:14px; width:100%; outline: none; }
.table-select {
  border: 1px solid var(--c-border);
  background: #F8FAFC;
  border-radius: 8px;
  padding: 8px 12px;
  font-size: 13px;
  font-weight: 600;
  color: var(--c-text-main);
  outline: none;
  width: 100%;
}
.table-select:focus { border-color: var(--c-orange); background: white; }
.accent-text { font-size:14px; font-weight:600; color:var(--c-orange); }
.remove-icon { color: #EF4444; cursor: pointer; text-align: center; font-size: 20px; font-weight: 800; display: flex; align-items: center; justify-content: flex-end; }

@media (max-width: 768px) {
  .recipient-header { display: none !important; }
  .recipient-row.stacked-mobile {
    grid-template-columns: 1fr;
    gap: 12px;
    padding: 20px;
    background: #fcfcfd;
    margin-bottom: 10px;
    border: 1px solid var(--c-border);
    border-radius: 16px;
  }
  .table-select, .table-input {
    background: white;
    border: 1px solid var(--c-border);
    padding: 12px;
    border-radius: 10px;
  }
  .remove-icon {
    justify-content: center;
    padding-top: 10px;
    border-top: 1px dashed var(--c-border);
    font-size: 14px;
    margin-top: 5px;
  }
}

.add-row-btn {
  background: none;
  border: 1px dashed var(--c-border);
  width: 100%;
  padding: 16px;
  border-radius: var(--r-pill);
  color: var(--c-text-sec);
  font-weight: 600;
  cursor: pointer;
  margin-top: 16px;
  transition: all 0.2s;
}
.add-row-btn:hover { border-color: var(--c-green); color: var(--c-green); }

#app .summary-card {
  background: #001f3f !important;
  color: #fff !important;
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
  margin-top: 16px;
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
  background-color: var(--c-orange) !important;
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
