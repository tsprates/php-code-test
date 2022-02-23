<template>
  <div id="app">
    <c-box
      border-width="1px"
      rounded="lg"
      overflow="hidden"
      my="5"
      mx="auto"
      p="2"
      w="960px"
    >
      <c-box
        border-width="1"
        border-color="gray.300"
        w="100%"
        p="4"
        font-size="3.5rem"
        font-weight="bold"
      >
        Register Customer
      </c-box>
      <h2 mb="3"></h2>
      <c-form-control>
        <c-form-label for="name" pt="3" pb="1">Name:</c-form-label>
        <c-input-group>
          <c-input-left-element
            ><c-icon name="info" color="gray.300"
          /></c-input-left-element>
          <c-input
            id="name"
            v-model="name"
            placeholder="Type the name"
            size="lg"
          />
        </c-input-group>
      </c-form-control>
      <c-form-control>
        <c-form-label for="email" pt="3" pb="1">Email:</c-form-label>
        <c-input-group>
          <c-input-left-element
            ><c-icon name="email" color="gray.300"
          /></c-input-left-element>
          <c-input
            id="email"
            v-model="email"
            placeholder="Type the email"
            size="lg"
          />
        </c-input-group>
      </c-form-control>
      <c-form-control>
        <c-form-label for="phone" pt="3" pb="1">Phone:</c-form-label>
        <c-input-group>
          <c-input-left-element
            ><c-icon name="phone" color="gray.300"
          /></c-input-left-element>
          <c-input
            id="phone"
            v-model="phone"
            placeholder="Type the phone"
            size="lg"
          />
        </c-input-group>
      </c-form-control>
      <c-form-control>
        <c-form-label for="country" pt="3" pb="1">Country:</c-form-label>
        <country-list
          id="country"
          v-model="address.country"
          @countryChange="(value) => (this.address.country = value)"
          size="lg"
        />
      </c-form-control>
      <c-form-control v-if="address.country === 'US'">
        <c-form-label for="us-state" pt="3" pb="1">State:</c-form-label>
        <us-state-list
          id="us-state"
          v-model="address.state"
          @usStateChange="(value) => (this.address.state = value)"
          size="lg"
        />
      </c-form-control>
      <c-form-control v-if="address.country === 'CA'">
        <c-form-label for="ca-province" pt="3" pb="1">Province:</c-form-label>
        <ca-province-list
          id="ca-province"
          v-model="address.state"
          @usStateChange="(value) => (this.address.state = value)"
          size="lg"
        />
      </c-form-control>
      <c-form-control
        v-if="address.country !== 'CA' && address.country !== 'US'"
      >
        <c-form-label for="state" pt="3" pb="1">State:</c-form-label>
        <c-input
          id="state"
          v-model="address.state"
          placeholder="Type the state"
          size="lg"
        />
      </c-form-control>
      <c-form-control>
        <c-form-label for="city" pt="3" pb="1">City:</c-form-label>
        <c-input
          id="city"
          v-model="address.city"
          placeholder="Type the name"
          size="lg"
        />
      </c-form-control>
      <c-form-control>
        <c-form-label for="number" pt="3" pb="1">Number:</c-form-label>
        <c-input
          id="number"
          v-model="address.number"
          placeholder="Type the house number"
          size="lg"
        />
      </c-form-control>
      <c-box mt="3" text-align="right">
        <c-button
          variant-color="green"
          @click="showToast('Saved successfully.')"
          size="lg"
          mr="2"
          >Save</c-button
        >
        <c-button
          variant-color="red"
          @click="showToast('Saved successfully.')"
          size="lg"
          >Cancel</c-button
        >
      </c-box>
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
    };
  },
  methods: {
    showToast(msg) {
      console.log(this.address);
      this.$toast({
        position: "top-right",
        title: "Warning",
        description: msg,
        status: "info",
        variant: "subtle",
      });
    },
  },
};
</script>
