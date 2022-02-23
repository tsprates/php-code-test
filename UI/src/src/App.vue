<template>
  <div id="app">
    <c-box my="5" mx="auto" p="2" w="960px">
      <c-box
        border-bottom-width="1px"
        border-bottom-color="gray.300"
        w="100%"
        p="4"
        mb="5"
        font-size="3.5rem"
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
            @usStateChange="(value) => (this.address.state = value)"
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
          <c-form-label for="number" pt="3" pb="1">Number:</c-form-label>
          <c-input
            id="number"
            v-model="address.number"
            placeholder="Type the house number"
          />
        </c-form-control>
        <c-box mt="5">
          <c-button
            type="submit"
            variant-color="green"
            width="100%"
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
        state: { required },
        city: {
          required,
        },
      },
    };

    if (this.address.country !== "CA" && this.address.country !== "US") {
      validations["state"] = {};
    }

    return validations;
  },
  methods: {
    submit() {
      this.isSubmitting = true;

      this.$v.$touch();

      // validation for country and state
      this.$refs.country.$v.$touch();
      if (this.address.country === "CA") {
        this.$refs["ca-province"].$v.$touch();
      } else if (this.address.country === "US") {
        this.$refs["us-state"].$v.$touch();
      }

      if (this.$v.$invalid) {
        this.showErrorToast("Error", "Something occured!");
      } else {
        this.showSucessToast("Sucess", "Saved successfully!");
      }

      setTimeout(() => {
        this.isSubmitting = false;
      }, 3000);
    },
    getcolor(value) {
      return value ? "red" : "gray.300";
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
.form-error-input {
  border-color: red;
}
</style>