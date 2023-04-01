<template>
  <v-form ref="machinery_form_ref">
    <v-row>
      <v-col cols="12">
        <v-select
          v-model="form.category_id"
          :error-messages="errors.category_id"
          :items="formOptions.categories"
          label="Categoria"
          class="overline"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model="form.no_serie"
          :error-messages="errors.no_serie"
          label="No. Serie"
          class="overline"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model="form.model"
          :error-messages="errors.model"
          label="Modelo"
          class="overline"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-textarea
          v-model="form.description"
          :error-messages="errors.description"
          label="Descripcion"
          class="overline"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model.number="form.price"
          :error-messages="errors.price"
          label="Costo del Equipo"
          class="overline"
          type="number"
          prefix="$"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model="form.acquisition_date"
          :error-messages="errors.acquisition_date"
          label="Fecha de la Adquisicion"
          class="overline"
          type="date"
          outlined
          dense
        />
      </v-col>
      <v-col cols="12">
        <v-file-input
          v-model="form.images"
          :error="errors.images"
          label="Fotos del Equipo"
          prepend-icon="mdi-camera"
          accept="image/*"
          truncate-length="30"
          small-chips
          multiple
          show-size
          counter
          outlined
          dense
        />
      </v-col>
    </v-row>
  </v-form>
</template>
<script>
export default {
  name: "MachineryForm",

  props: {
    form: { type: Object, required: true },
    errors: Object,
    formOptions: Array,
  },

  data() {
    return {};
  },
};
</script>

<style >
</style>
