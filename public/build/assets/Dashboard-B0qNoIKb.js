import{_ as l}from"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";import{_ as h}from"./VStretchedButton.vue_vue_type_script_setup_true_lang-Cg1zX6vC.js";import{_ as u}from"./DressingCard.vue_vue_type_script_setup_true_lang-CrHdjN7L.js";import{_ as p}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-DNp2ZTF-.js";import{a as n,c as d,h as t,d as _,f as s,g as a,e as r,F as c,Z as g,t as o,i as f,s as v,b as w}from"./app-Dx26qlXV.js";import{r as x}from"./PlusIcon-DH-9V8Js.js";import{r as $}from"./TagIcon-5Mc_hjnz.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./generated-Ca4FKDe-.js";import"./NoLayout.vue_vue_type_script_setup_true_lang-S_It9hZt.js";function k(m,e){return n(),d("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"})])}const y={class:"flex flex-wrap items-center justify-between gap-2"},b={class:"text-xl font-semibold leading-tight text-gray-800"},C={class:"flex flex-wrap gap-2"},B={class:"max-md:sr-only"},V={class:"mx-auto mt-auto flex w-full max-w-lg flex-col justify-end gap-2"},T=_({__name:"Dashboard",props:{dressings:{}},setup(m){return(e,Z)=>(n(),d(c,null,[s(a(g),{title:e.$t("dashboard")},null,8,["title"]),s(p,null,{header:r(()=>[t("div",y,[t("h2",b,o(e.$t("dressings")),1),t("div",C,[s(l,{class:"ms-auto",href:e.route("dressings.create")},{default:r(()=>[s(a(x),{class:"size-5"}),f(" "+o(e.$t("dressing")),1)]),_:1},8,["href"]),s(l,{href:e.route("clothes-categories.index"),variant:"secondary"},{default:r(()=>[s(a($),{class:"size-5"}),f(" "+o(e.$t("catgories")),1)]),_:1},8,["href"]),s(l,{href:e.route("overview"),variant:"tertiary"},{default:r(()=>[s(a(k),{class:"size-5"}),t("span",B,o(e.$t("vue_densemble")),1)]),_:1},8,["href"])])])]),default:r(()=>[t("div",V,[(n(!0),d(c,null,v(e.dressings,i=>(n(),w(h,{"sr-text":i.name,href:e.route("dressings.show",{dressing:i})},{default:r(()=>[s(u,{dressing:i},null,8,["dressing"])]),_:2},1032,["sr-text","href"]))),256))])]),_:1})],64))}});export{T as default};