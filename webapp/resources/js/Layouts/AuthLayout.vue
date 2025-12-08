<template>
    <v-app>
        <v-main>
            <v-row class="bg-lightprimary position-relative h-screen" no-gutters>
                <v-col cols="12" class="d-none d-md-flex">
                    <div class="pt-5 pl-6">
                        Geoglify
                        <LanguageSwitcher />
                    </div>
                </v-col>
                <!---Login Part-->
                <v-col cols="12" lg="12" class="d-flex align-center">
                    <v-container>
                        <div class="d-flex align-center justify-center" style="min-height: calc(100vh - 148px)">
                            <v-row justify="center">
                                <v-col cols="12" md="12">
                                    <v-card elevation="0" class="loginBox">
                                        <v-card elevation="24">
                                            <v-card-text class="pa-sm-10 pa-6">
                                                <div class="d-flex d-md-none justify-center mb-5">
                                                    <Logo />
                                                </div>
                                                <slot />
                                            </v-card-text>
                                        </v-card>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </div>
                    </v-container>
                </v-col>
            </v-row>
        </v-main>
    </v-app>
</template>

<script setup>
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
</script>


<style lang="scss">
.loginBox {
    max-width: 475px;
    margin: 0 auto;
}

.blur-logo {
    position: absolute;
    filter: blur(18px);
    bottom: 0;
    transform: inherit;
}

.bg-containerBg {
    background-color: #dbeefc
}
</style>
