import MainLayout from "layouts/MainLayout.vue";
import IndexPage from "pages/IndexPage.vue";
import AboutPage from "src/pages/AboutPage.vue";
import ContactPage from "src/pages/ContactPage.vue";

const routes = [
  {
    path: "/",
    component: MainLayout,
    children: [
      {
        path: "",
        name: "index",
        component: IndexPage,
      },
      {
        path: "/contact",
        name: "contact",
        component: ContactPage,
      },
      {
        path: "/about",
        name: "about",
        component: AboutPage,
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
