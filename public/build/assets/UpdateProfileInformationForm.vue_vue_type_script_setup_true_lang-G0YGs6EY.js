import{d as g,a8 as y,T as h,c as m,h as a,t as i,f as o,g as t,i as u,e as d,w as $,C as V,k as _,a7 as k,j as b,a as f,p as w}from"./app-Dx26qlXV.js";import{_ as x}from"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";import{_ as c}from"./VInput.vue_vue_type_script_setup_true_lang-QYCJZ-3d.js";import{_ as p}from"./InputError.vue_vue_type_script_setup_true_lang-CSY0_wNj.js";import{_ as v}from"./InputLabel.vue_vue_type_script_setup_true_lang-pdtxuEB6.js";const q={class:"text-lg font-medium text-gray-900"},C={class:"mt-1 text-sm text-gray-600"},N={key:0},S={class:"mt-2 text-sm text-gray-800"},B={class:"flex items-center gap-4"},E={key:0,class:"text-sm text-gray-600"},I=g({__name:"UpdateProfileInformationForm",props:{mustVerifyEmail:{},status:{}},setup(T){const n=y().props.auth.user,s=h({name:n.name,email:n.email});return(e,r)=>(f(),m("section",null,[a("header",null,[a("h2",q,i(e.$t("informations_du_profil")),1),a("p",C,i(e.$t("mettez_jour_les_informations_de_profil_et_ladresse")),1)]),a("form",{onSubmit:r[2]||(r[2]=b(l=>t(s).patch(e.route("profile.update")),["prevent"])),class:"mt-6 space-y-6"},[a("div",null,[o(v,{for:"name",value:e.$t("nom")},null,8,["value"]),o(c,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:t(s).name,"onUpdate:modelValue":r[0]||(r[0]=l=>t(s).name=l),required:"",autocomplete:"name"},null,8,["modelValue"]),o(p,{class:"mt-2",message:t(s).errors.name},null,8,["message"])]),a("div",null,[o(v,{for:"email",value:e.$t("email")},null,8,["value"]),o(c,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(s).email,"onUpdate:modelValue":r[1]||(r[1]=l=>t(s).email=l),required:"",autocomplete:"username"},null,8,["modelValue"]),o(p,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),e.mustVerifyEmail&&t(n).email_verified_at===null?(f(),m("div",N,[a("p",S,[u(i(e.$t("votre_adresse_lectronique_nest_pas_vrifie"))+" ",1),o(t(w),{href:e.route("verification.send"),method:"post",as:"button",class:"rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:d(()=>[u(i(e.$t("cliquez_ici_pour_renvoyer_lemail_de_vrification")),1)]),_:1},8,["href"])]),$(a("div",{class:"mt-2 text-sm font-medium text-green-600"},i(e.$t("un_nouveau_lien_de_vrification_a_t_envoy_votre_adr")),513),[[V,e.status==="verification-link-sent"]])])):_("",!0),a("div",B,[o(x,{type:"submit",disabled:t(s).processing},{default:d(()=>[u(i(e.$t("enregistrer")),1)]),_:1},8,["disabled"]),o(k,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:d(()=>[t(s).recentlySuccessful?(f(),m("p",E,i(e.$t("enregistr")),1)):_("",!0)]),_:1})])],32)]))}});export{I as _};
