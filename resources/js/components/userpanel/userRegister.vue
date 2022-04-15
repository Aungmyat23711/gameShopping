<template>
  <div class="registerFrame">
    <v-form ref="form">
      <v-card class="mx-auto" width="500">
        <v-card-title class="justify-space-between">
          <span class="text-h6 font-weight-regular">{{ currentTitle }}</span>
        </v-card-title>
        <v-window v-model="step">
          <v-window-item :value="1">
            <v-card-text>
              <v-text-field
                prepend-inner-icon="drive_file_rename_outline"
                label="Enter Your Name"
                solo
                :rules="validate.nameError"
                v-model="form.name"
                clearable
              />
              <v-text-field
                prepend-inner-icon="email"
                label="Enter Your Email"
                solo
                :rules="validate.emailError"
                v-model="form.email"
                clearable
              />
            </v-card-text>
          </v-window-item>
          <v-window-item :value="2">
            <v-card-text>
              <v-text-field
                prepend-inner-icon="password"
                :append-icon="passCon ? 'visibility' : 'visibility_off'"
                :type="passCon ? 'text' : 'password'"
                label="Enter Password"
                solo
                @click:append="passCon = !passCon"
                :rules="validate.passError"
                v-model="form.pass"
                clearable
                value=""
              />
              <v-text-field
                prepend-inner-icon="lock"
                :append-icon="cpassCon ? 'visibility' : 'visibility_off'"
                :type="cpassCon ? 'text' : 'password'"
                label="Enter Confirm Password"
                solo
                @click:append="cpassCon = !cpassCon"
                :rules="validate.cpassError"
                v-model="form.cpass"
                clearable
                value=""
              />
            </v-card-text>
          </v-window-item>
          <v-window-item :value="3">
            <v-card-text class="text-center">
              <v-avatar size="200">
                <img src="/resources/gameicon.png" alt="gi" />
              </v-avatar>
              <v-divider></v-divider>
              <span style="color: #fff" class="subtitle-1"
                >Go Login And Enjoy Shopping!</span
              >
            </v-card-text>
          </v-window-item>
        </v-window>
        <v-card-actions>
          <v-btn
            color="#fff"
            text
            @click="goBack"
            :disabled="step === 1 || step === 3 ? true : false"
          >
            <v-icon>arrow_left</v-icon>
            <span>Back</span>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn @click="step === 3 ? goLogin() : goNext()">
            <span>{{ step === 3 ? "Login" : "Next" }}</span>
            <v-icon>arrow_right</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </div>
</template>

<script>
import "../../../css/login.css";
export default {
  data() {
    return {
      step: 1,
      passCon: false,
      cpassCon: false,
      form: {
        name: "",
        email: "",
        pass: "",
        cpass: "",
      },
      validate: {
        nameError: [(v) => !!v || "Name field is required"],
        emailError: [
          (v) => !!v || "Email field is required",
          (v) =>
            !v ||
            /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
            "E-mail must be valid",
        ],
        passError: [
          (v) => !!v || "Password field is required",
          (v) => v.length > 4 || "Password should be at least 4 character",
        ],
        cpassError: [
          (v) => !!v || "Confirm Password field is required",
          (v) => v.length > 4 || "Password should be at least 4 character",
          (v) => v === this.form.pass || "Confirm Password not the same",
        ],
      },
    };
  },
  computed: {
    currentTitle() {
      switch (this.step) {
        case 1:
          return "Enter Your Information";
        case 2:
          return "Enter Your Password";
        default:
          return "Account Created";
      }
    },
  },
  methods: {
    async goNext() {
      if (this.$refs.form.validate()) {
        if (this.step == 2) {
          await axios
            .post("/api/registerUser", {
              name: this.form.name,
              email: this.form.email,
              password: this.form.pass,
            })
            .then((resp) => {
              this.step = this.step + 1;
            });
        } else {
          this.step = this.step + 1;
        }
      }
    },
    goBack() {
      if (this.$refs.form.validate()) {
        this.step = this.step - 1;
      }
    },
  },
};
</script>

<style>
</style>