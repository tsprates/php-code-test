<template>
  <div id="app">
    <c-box my="5" mx="auto" p="2" w="960px">
      <c-box
        border-bottom-width="5px"
        border-bottom-color="green.500"
        w="100%"
        pt="1"
        mb="2"
        font-size="3.2rem"
        font-weight="bold"
      >
        Register Customer
      </c-box>
      <form @submit.prevent="submit">
        <c-form-control>
          <c-form-label for="name" pt="3" pb="1">Name:</c-form-label>
          <c-input-group>
            <c-input-left-element
              ><c-icon name="info" :color="getcolor($v.name.$error)"
            /></c-input-left-element>
            <c-input
              id="name"
              placeholder="Provide your name"
              v-model.trim="$v.name.$model"
              :border-color="getcolor($v.name.$error)"
              :color="getcolor($v.name.$error)"
            />
          </c-input-group>
          <template v-if="$v.name.$error">
            <div class="form-error-msg" v-if="!$v.name.required">
              Name is required.
            </div>
            <div class="form-error-msg" v-if="!$v.name.minLength">
              Name must have at least
              {{ $v.name.$params.minLength.min }} letters.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="email" pt="3" pb="1">Email:</c-form-label>
          <c-input-group>
            <c-input-left-element
              ><c-icon name="email" :color="getcolor($v.email.$error)"
            /></c-input-left-element>
            <c-input
              id="email"
              placeholder="Provide your email"
              v-model.trim="$v.email.$model"
              :border-color="getcolor($v.email.$error)"
              :color="getcolor($v.email.$error)"
            />
          </c-input-group>
          <template v-if="$v.email.$error">
            <div class="form-error-msg" v-if="!$v.email.required">
              Email is required.
            </div>
            <div class="form-error-msg" v-if="!$v.email.email">
              Invalid email.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="phone" pt="3" pb="1">Phone:</c-form-label>
          <c-input-group>
            <c-input-left-element
              ><c-icon name="phone" :color="getcolor($v.phone.$error)"
            /></c-input-left-element>
            <c-input
              id="phone"
              placeholder="Provide your phone"
              v-model.trim="$v.phone.$model"
              :border-color="getcolor($v.phone.$error)"
              :color="getcolor($v.phone.$error)"
            />
          </c-input-group>
          <template v-if="$v.phone.$error">
            <div class="form-error-msg" v-if="!$v.phone.required">
              Phone is required.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="country" pt="3" pb="1">Country:</c-form-label>
          <country-list
            id="country"
            ref="country"
            @countryChange="changeCountry"
          />
        </c-form-control>
        <c-form-control v-if="address.country === 'US'">
          <c-form-label for="us-state" pt="3" pb="1">State:</c-form-label>
          <us-state-list
            id="us-state"
            ref="us-state"
            @usStateChange="(value) => (this.address.state = value)"
          />
        </c-form-control>
        <c-form-control v-if="address.country === 'CA'">
          <c-form-label for="ca-province" pt="3" pb="1">Province:</c-form-label>
          <ca-province-list
            id="ca-province"
            ref="ca-province"
            @caProvinceChange="(value) => (this.address.state = value)"
          />
        </c-form-control>
        <c-form-control
          v-if="address.country !== 'CA' && address.country !== 'US'"
        >
          <c-form-label for="state" pt="3" pb="1">State:</c-form-label>
          <c-input
            id="state"
            ref="state"
            placeholder="Type the state"
            v-model.trim="$v.address['state'].$model"
            :border-color="getcolor($v.address['state'].$error)"
            :color="getcolor($v.address['state'].$error)"
          />
          <template v-if="$v.address['state'].$error">
            <div class="form-error-msg" v-if="!$v.address['state'].required">
              State is required.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="city" pt="3" pb="1">City:</c-form-label>
          <c-input
            id="city"
            placeholder="Type the city"
            v-model.trim="$v.address['city'].$model"
            :border-color="getcolor($v.address['city'].$error)"
            :color="getcolor($v.address['city'].$error)"
          />
          <template v-if="$v.address['city'].$error">
            <div class="form-error-msg" v-if="!$v.address['city'].required">
              City is required.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="street" pt="3" pb="1">Street:</c-form-label>
          <c-input
            id="street"
            placeholder="Provide the street"
            v-model.trim="$v.address['street'].$model"
            :border-color="getcolor($v.address['street'].$error)"
            :color="getcolor($v.address['street'].$error)"
          />
          <template v-if="$v.address['street'].$error">
            <div class="form-error-msg" v-if="!$v.address['street'].required">
              Street is required.
            </div>
            <div class="form-error-msg" v-if="!$v.address['street'].minLength">
              Street must have at least
              {{ $v.address["street"].$params.minLength.min }} letters.
            </div>
          </template>
        </c-form-control>
        <c-form-control>
          <c-form-label for="number" pt="3" pb="1">Number:</c-form-label>
          <c-input
            id="number"
            placeholder="Type the house number"
            v-model.trim="$v.address['number'].$model"
            :border-color="getcolor($v.address['number'].$error)"
            :color="getcolor($v.address['number'].$error)"
          />
          <template v-if="$v.address['number'].$error">
            <div class="form-error-msg" v-if="!$v.address['number'].required">
              Number is required.
            </div>
          </template>
        </c-form-control>
        <c-box mt="10">
          <c-button
            type="submit"
            variant-color="green"
            width="100%"
            size="lg"
            :is-loading="isSubmitting"
            >Save</c-button
          >
        </c-box>
      </form>
    </c-box>
  </div>
</template>

<script>
import CountryList from "./components/CountryList.vue";
import UsStateList from "./components/UsStateList.vue";
import CaProvinceList from "./components/CaProvinceList.vue";
import {
  CBox,
  CButton,
  CInput,
  CInputGroup,
  CInputLeftElement,
  CFormControl,
  CFormLabel,
  CIcon,
} from "@chakra-ui/vue";
import { required, email, minLength } from "vuelidate/lib/validators";

export default {
  name: "App",
  components: {
    CountryList,
    UsStateList,
    CaProvinceList,
    CBox,
    CFormControl,
    CFormLabel,
    CInput,
    CInputGroup,
    CInputLeftElement,
    CButton,
    CIcon,
  },
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      address: {
        number: "",
        street: "",
        city: "",
        state: "",
        country: "",
      },
      isSubmitting: false,
    };
  },
  created() {
    document.title = "Register Customers";
  },
  validations() {
    let validations = {
      name: {
        required,
        minLength: minLength(5),
      },
      email: {
        required,
        email,
      },
      phone: {
        required,
      },
      address: {
        state: {
          required,
        },
        street: {
          required,
          minLength: minLength(5),
        },
        city: {
          required,
        },
        number: {
          required,
        },
      },
    };

    return validations;
  },
  methods: {
    submit() {
      this.$v.$touch();

      // validation for country and state
      this.$refs.country.$v.$touch();
      if (this.address.country === "CA") {
        this.$refs["ca-province"].$v.$touch();
      } else if (this.address.country === "US") {
        this.$refs["us-state"].$v.$touch();
      }

      if (!this.$v.$invalid) {
        this.isSubmitting = true;

        this.axios
          .post("/customers", {
            name: this.name,
            email: this.email,
            phone: this.phone,
            address: {
              number: this.address.number,
              street: this.address.street,
              city: this.address.city,
              state: this.address.state,
              country: this.address.country,
            },
          })
          .then((response) => {
            if (response.data.success === true) {
              this.showSucessToast("Sucess", "Saved successfully!");
            } else {
              this.showErrorToast("Error", "Something occured!");
            }
            this.isSubmitting = false;
            this.clearForm();
          })
          .catch(() => {
            this.showErrorToast("Error", "Something occured!");
            this.isSubmitting = false;
          });
      }
    },
    clearForm() {
      // reset validation errors
      this.$v.$reset();
      this.$refs.country.$v.country.$model = "";
      this.$refs.country.$v.$reset();
      if (this.address.country === "CA") {
        this.$refs["ca-province"].$v.province.$model = "";
        this.$refs["ca-province"].$v.$reset();
      } else if (this.address.country === "US") {
        this.$refs["us-state"].$v.state.$model = "";
        this.$refs["us-state"].$v.$reset();
      }

      // clear data
      this.name = "";
      this.email = "";
      this.phone = "";
      this.address.country = "";
      this.address.state = "";
      this.address.city = "";
      this.address.street = "";
      this.address.number = "";
    },
    getcolor(value) {
      return value ? "red" : "gray.500";
    },
    changeCountry(value) {
      this.address.country = value;
      this.address.state = "";
    },
    showSucessToast(title, msg) {
      this.$toast({
        position: "top",
        title: title,
        description: msg,
        status: "success",
      });
    },
    showErrorToast(title, msg) {
      this.$toast({
        position: "top",
        title: title,
        description: msg,
        status: "error",
      });
    },
  },
};
</script>

<style scoped>
.form-error-msg {
  color: red;
}
</style>