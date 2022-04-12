let colors = {
  primary : '#339af7',
  success : '#3cc37d',
  danger  : '#f03c4b',
  warning : '#fa9632',
  dark    : '#303030',
}

// CONFIGS
const themeConfig = {
  disableCustomizer : true,        // options[Boolean] : true, false(default)
  disableThemeTour  : false,       // options[Boolean] : true, false(default)
  footerType        : "static",    // options[String]  : static(default) / sticky / hidden
  hideScrollToTop   : false,       // options[Boolean] : true, false(default)
  mainLayoutType    : "vertical",  // options[String]  : vertical(default) / horizontal
  navbarColor       : "#fff",   // options[String]  : HEX color / rgb / rgba / Valid HTML Color name - (default: #fff)
  navbarType        : "floating",  // options[String]  : floating(default) / static / sticky / hidden
  routerTransition  : "zoom-fade", // options[String]  : zoom-fade / slide-fade / fade-bottom / fade / zoom-out / none(default)
  rtl               : false,       // options[Boolean] : true, false(default)
  sidebarCollapsed  : false,       // options[Boolean] : true, false(default)
  theme             : "light",     // options[String]  : "light"(default), "dark", "semi-dark"

  // Not required yet - WIP
  userInfoLocalStorageKey: "userInfo",

  // NOTE: themeTour will be disabled in screens < 1200. Please refer docs for more info.
}

import Vue from 'vue'
import Vuesax from 'vuesax'
Vue.use(Vuesax, { theme:{ colors }, rtl: themeConfig.rtl })

export default themeConfig
