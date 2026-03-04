<template>
  <div class="pin-setup-container d-flex flex-column align-items-center justify-content-center py-10">
    <div class="card pin-card border-0 shadow-sm w-100" style="max-width: 450px;">
      <div class="card-body p-10 text-center">
        <!-- Icon & Header -->
        <div class="mb-8">
          <div class="pin-icon-wrapper bg-light-primary text-primary mb-6 mx-auto" style="background-color: rgba(0, 31, 63, 0.05) !important; color: #001f3f !important">
            <i class="flaticon-lock icon-2x"></i>
          </div>
          <h2 class="font-weight-bolder text-dark mb-2">Set Transaction PIN</h2>
          <p class="text-muted font-weight-bold">
            Create a 4-digit PIN to secure your transactions and account activities.
          </p>
        </div>

        <!-- PIN Form -->
        <form @submit.prevent="setPin">
          <div class="pin-inputs d-flex justify-content-center mb-10">
            <input
              v-for="(digit, index) in 4"
              :key="index"
              :id="'pin-' + index"
              ref="pinInputs"
              type="text"
              inputmode="numeric"
              pattern="[0-9]*"
              maxlength="1"
              class="form-control pin-input mx-2 text-center font-weight-bolder font-size-h1"
              v-model="pinDigits[index]"
              @input="handleInput($event, index)"
              @keydown.delete="handleDelete($event, index)"
              @paste="handlePaste"
              required
              autocomplete="one-time-code"
            />
          </div>

          <div class="alert alert-custom alert-light-warning fade show mb-8 py-4 px-6 border-0 text-start" role="alert" style="background-color: rgba(251, 145, 41, 0.1) !important">
            <div class="alert-icon">
              <i class="flaticon-warning text-warning" style="color: #fb9129 !important"></i>
            </div>
            <div class="alert-text font-size-sm font-weight-bold text-warning" style="color: #fb9129 !important">
              Keep your PIN secret. Do not share it with anyone, including VTUBiz staff.
            </div>
          </div>

          <button
            type="submit"
            class="btn btn-lg w-100 font-weight-bolder text-uppercase py-4 shadow-sm pin-submit-btn"
            :disabled="!isPinComplete || loading"
          >
            <span v-if="loading" class="spinner-border spinner-border-sm mr-2"></span>
            {{ loading ? 'Setting PIN...' : 'Secure My Account' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      pinDigits: ["", "", "", ""],
      loading: false
    };
  },
  computed: {
    isPinComplete() {
      return this.pinDigits.every(digit => digit !== "" && /^\d$/.test(digit));
    }
  },
  methods: {
    handleInput(event, index) {
      const value = event.target.value;
      
      // Ensure only numbers
      if (!/^\d*$/.test(value)) {
        this.pinDigits[index] = "";
        return;
      }

      if (value.length > 0) {
        // Move to next input
        if (index < 3) {
          this.$nextTick(() => {
            this.$refs.pinInputs[index + 1].focus();
          });
        }
      }
    },
    handleDelete(event, index) {
      if (this.pinDigits[index] === "" && index > 0) {
        // Move to previous input on backspace if current is empty
        this.$refs.pinInputs[index - 1].focus();
      }
    },
    handlePaste(event) {
      const paste = (event.clipboardData || window.clipboardData).getData('text');
      if (/^\d{4}$/.test(paste)) {
        this.pinDigits = paste.split('');
        this.$refs.pinInputs[3].focus();
      }
      event.preventDefault();
    },
    setPin() {
      if (!this.isPinComplete) return;
      
      this.loading = true;
      let fd = new FormData();
      fd.append("first", this.pinDigits[0]);
      fd.append("second", this.pinDigits[1]);
      fd.append("third", this.pinDigits[2]);
      fd.append("fourth", this.pinDigits[3]);
      fd.append("user_id", this.user.uuid);

      axios.post("setpin", fd)
        .then((response) => {
          if (response.data == true) {
            Swal.fire({
              icon: 'success',
              title: 'PIN Set Successfully!',
              text: 'Your account is now secured.',
              showConfirmButton: false,
              timer: 2000
            }).then(() => {
              location.reload();
            });
          } else {
            throw new Error('Failed to set PIN');
          }
        })
        .catch((error) => {
          this.loading = false;
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Could not set PIN. Please try again later.'
          });
        });
    },
  },
  mounted() {
    // Auto focus first input
    this.$nextTick(() => {
      this.$refs.pinInputs[0].focus();
    });
  },
};
</script>

<style scoped>
.pin-setup-container {
  min-height: 400px;
}

.pin-card {
  border-radius: 24px;
}

.pin-icon-wrapper {
  width: 70px;
  height: 70px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.pin-input {
  width: 60px;
  height: 70px;
  border: 2px solid #f3f6f9;
  border-radius: 16px;
  background-color: #f3f6f9;
  transition: all 0.3s ease;
}

.pin-input:focus {
  border-color: #fb9129;
  background-color: white;
  box-shadow: 0 4px 12px rgba(251, 145, 41, 0.1);
  transform: translateY(-2px);
}

.pin-submit-btn {
  background-color: #001f3f;
  color: white;
  border: none;
}

.pin-submit-btn:hover:not(:disabled) {
  background-color: #002f5f;
  color: white;
}

.pin-submit-btn:disabled {
  background-color: #ebedf3;
  color: #b5b5c3;
}

.letter-spacing-5 {
  letter-spacing: 5px;
}

@media (max-width: 575px) {
  .pin-input {
    width: 50px;
    height: 60px;
    font-size: 1.5rem !important;
  }
}
</style>