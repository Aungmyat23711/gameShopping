<template>
  <div class="footerFrame">
    <v-row>
      <v-col cols="6" md="4" sm="6">
        <ul class="footerul">
          <li>Get to know us</li>
          <li class="subtitle-1">About us</li>
          <li class="subtitle-1">Contact us</li>
        </ul>
      </v-col>
      <v-col cols="6" md="4" sm="6">
        <div>Subscribe</div>
        <p class="subtitle-1" style="color: rgb(102, 101, 101)">
          By subscribing you agree to receive email from us.
        </p>
        <div class="inputform">
          <input type="text" class="input" placeholder="Email Address" />
          <div class="icon">
            <v-icon color="#000000">send</v-icon>
          </div>
        </div>
      </v-col>
      <v-col cols="12" md="4" sm="6">
        <div class="fu">Follow Us</div>
        <ul class="followus">
          <li class="subtitle-1">FaceBook</li>
          <li class="subtitle-1">Twitter</li>
          <li class="subtitle-1">Instagram</li>
        </ul>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      back: "Welcome",
    };
  },
};
</script>

<style>
.footerFrame {
  width: 100%;
}
.footerul {
  list-style: none;
}
.footerul li:first-child {
  color: #fff;
}
.footerul li {
  color: rgb(102, 101, 101);
}
.inputform {
  display: flex;
  position: relative;
}
.input {
  background: #fff;
  padding: 5px;
  width: 100%;
}
.icon {
  position: absolute;
  right: 5px;
  top: 4px;
}
.followus {
  list-style: none;
  padding: 0 !important;
}

.followus li {
  display: inline-block;
  padding: 10px 10px 10px 0;
  color: rgb(102, 101, 101);
}
</style>