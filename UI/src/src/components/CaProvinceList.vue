<template>
  <c-select
    placeholder="Choose a province"
    @change="$emit('caProvinceChange', province)"
    v-model.trim="$v.province.$model"
    :border-color="$v.province.$error ? 'red' : 'gray.500'"
    :color="$v.province.$error ? 'red' : 'gray.500'"
  >
    <option value="AB">Alberta</option>
    <option value="BC">British Columbia</option>
    <option value="MB">Manitoba</option>
    <option value="NB">New Brunswick</option>
    <option value="NL">Newfoundland and Labrador</option>
    <option value="NS">Nova Scotia</option>
    <option value="ON">Ontario</option>
    <option value="PE">Prince Edward Island</option>
    <option value="QC">Quebec</option>
    <option value="SK">Saskatchewan</option>
    <option value="NT">Northwest Territories</option>
    <option value="NU">Nunavut</option>
    <option value="YT">Yukon</option>
  </c-select>
</template>

<script>
import { CSelect } from "@chakra-ui/vue";
import { required } from "vuelidate/lib/validators";

export default {
  name: "CaProvinceList",
  components: {
    CSelect,
  },
  data() {
    return {
      province: "",
    };
  },
  validations: {
    province: {
      required,
    },
  },
};
</script>