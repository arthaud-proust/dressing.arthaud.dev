import{_ as m}from"./VStretchedButton.vue_vue_type_script_setup_true_lang-Cg1zX6vC.js";import{_}from"./DressingCard.vue_vue_type_script_setup_true_lang-CrHdjN7L.js";import{_ as D}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-DNp2ZTF-.js";import{d as w,l as B,r as p,c as i,f as e,g as c,e as r,F as u,a,Z as z,h as n,t as d,s as v,b as g,x as F}from"./app-Dx26qlXV.js";import{_ as j}from"./VPageHeader.vue_vue_type_script_setup_true_lang-fmw-Xnf0.js";import{b as N}from"./NoLayout.vue_vue_type_script_setup_true_lang-S_It9hZt.js";import{r as x}from"./ArrowRightIcon-CHakF1j5.js";import"./generated-Ca4FKDe-.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";const V={class:"mx-auto mt-auto w-full max-w-lg"},E={class:"text-xl"},I={class:"mt-2 flex flex-col justify-end gap-2"},L={class:"text-xl"},O={class:"mt-12 text-xl"},S={class:"mt-2 flex flex-col justify-end gap-2"},R=w({__name:"Index",props:{dressings:{}},setup(h){const $=h,k=B(()=>$.dressings.filter(t=>{var o;return t.id!==((o=l.value)==null?void 0:o.id)})),l=p(null),f=p(null),y=t=>l.value=t,C=t=>{f.value=t,F.visit(route("suitcase.show",[l.value,f.value]))};return(t,o)=>(a(),i(u,null,[e(c(z),{title:t.$t("faire_ma_valise")},null,8,["title"]),e(D,null,{header:r(()=>[e(j,{title:t.$t("faire_ma_valise")},null,8,["title"])]),default:r(()=>[n("div",V,[l.value?(a(),i(u,{key:1},[n("h3",L,d(t.$t("o_estu")),1),e(m,{"sr-text":t.$t("modifier_o_tu_es"),onClick:o[0]||(o[0]=s=>l.value=null),class:"mt-2"},{default:r(()=>[e(_,{dressing:l.value},null,8,["dressing"]),e(c(N),{class:"absolute right-8 top-1/2 size-6 -translate-y-1/2"})]),_:1},8,["sr-text"]),n("h3",O,d(t.$t("o_vastu")),1),n("div",S,[(a(!0),i(u,null,v(k.value,s=>(a(),g(m,{"sr-text":s.name,onClick:b=>C(s)},{default:r(()=>[e(_,{dressing:s},null,8,["dressing"]),e(c(x),{class:"absolute right-8 top-1/2 size-6 -translate-y-1/2"})]),_:2},1032,["sr-text","onClick"]))),256))])],64)):(a(),i(u,{key:0},[n("h3",E,d(t.$t("o_estu")),1),n("div",I,[(a(!0),i(u,null,v(t.dressings,s=>(a(),g(m,{"sr-text":s.name,onClick:b=>y(s)},{default:r(()=>[e(_,{dressing:s},null,8,["dressing"]),e(c(x),{class:"absolute right-8 top-1/2 size-6 -translate-y-1/2"})]),_:2},1032,["sr-text","onClick"]))),256))])],64))])]),_:1})],64))}});export{R as default};