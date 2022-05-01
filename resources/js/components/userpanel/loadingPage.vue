<template>
  <div class="frame">
    <v-progress-circular
      :size="70"
      :width="7"
      color="purple"
      indeterminate
    ></v-progress-circular>
  </div>
</template>

<script>
export default {};
</script>

<style scoped >
.frame {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>