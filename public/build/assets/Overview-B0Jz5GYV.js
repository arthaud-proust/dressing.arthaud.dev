import{_ as C}from"./VPageHeader.vue_vue_type_script_setup_true_lang-fmw-Xnf0.js";import{_ as v}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-DNp2ZTF-.js";import{D as t}from"./generated-Ca4FKDe-.js";import{d as y,c as r,f as i,g as E,e as b,F as c,a,Z as w,h as l,s as f,t as s,X as B,n as g}from"./app-Dx26qlXV.js";import"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./NoLayout.vue_vue_type_script_setup_true_lang-S_It9hZt.js";const D={class:"my-8 grid grid-cols-1 gap-20 md:grid-cols-2"},L={class:"mb-2 text-xl"},k={class:"flex flex-row gap-1 py-6"},V=y({__name:"Overview",props:{categories:{}},setup(A){const h=e=>e.toSorted((m,n)=>n.clothesCount-m.clothesCount),u=e=>{switch(e.color){case t.RED:return{container:"bg-red-100 text-red-950",title:"text-red-800"};case t.AMBER:return{container:"bg-amber-100 text-amber-950",title:"text-amber-800"};case t.LIME:return{container:"bg-lime-100 text-lime-950",title:"text-lime-800"};case t.EMERALD:return{container:"bg-emerald-100 text-emerald-950",title:"text-emerald-800"};case t.CYAN:return{container:"bg-cyan-100 text-cyan-950",title:"text-cyan-800"};case t.BLUE:return{container:"bg-blue-100 text-blue-950",title:"text-blue-800"};case t.VIOLET:return{container:"bg-violet-100 text-violet-950",title:"text-violet-800"};case t.FUCHSIA:return{container:"bg-fuchsia-100 text-fuchsia-950",title:"text-fuchsia-800"}}};return(e,m)=>(a(),r(c,null,[i(E(w),{title:e.$t("vue_densemble")},null,8,["title"]),i(v,null,{header:b(()=>[i(C,{"back-to":e.route("dashboard"),title:e.$t("vue_densemble")},null,8,["back-to","title"])]),default:b(()=>[l("div",D,[(a(!0),r(c,null,f(e.categories,({clothesCount:n,category:_,dressings:d})=>(a(),r("article",null,[l("h2",L,s(_.name)+" ("+s(n)+") ",1),l("ul",k,[(a(!0),r(c,null,f(h(d),({dressing:o,clothesCount:p},x)=>(a(),r("li",{class:"relative",style:B({flex:p+1})},[l("div",{class:g(["flex items-center justify-center rounded-md p-1 text-lg",u(o).container])},s(p),3),l("span",{class:g(["absolute min-w-full whitespace-nowrap p-0.5 text-center text-sm",[{"bottom-full":x%2===0,"right-0":x===d.length-1},u(o).title]])},s(o.name),3)],4))),256))])]))),256))])]),_:1})],64))}});export{V as default};