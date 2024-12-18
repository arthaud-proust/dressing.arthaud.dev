import{_ as j}from"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";import{_ as se}from"./VStretchedButton.vue_vue_type_script_setup_true_lang-Cg1zX6vC.js";import{r as de,_ as oe}from"./ClothingCard.vue_vue_type_script_setup_true_lang-B40oPW3c.js";import{a as g,c as b,h as C,D as N,E as re,G as H,H as D,I as q,J as G,K,r as v,S as ue,L as Z,M as fe,N as J,A as Q,O as pe,o as X,B as Y,P as S,Q as ce,R as ee,U as ge,l as ve,d as te,T as me,b as P,e as h,g as c,V as ye,W as he,s as R,F as T,f as y,i as $,t as w,w as be,z as Se,k as F,x as k,Z as we}from"./app-Dx26qlXV.js";import{V as Be}from"./VTag--xossPnz.js";import{V as Ce,_ as _e}from"./Modal.vue_vue_type_script_setup_true_lang-Bz1BfvKN.js";import{u as ne}from"./useClothesCategories-DPHyWEB8.js";import{r as Ee}from"./TagIcon-5Mc_hjnz.js";import{r as xe}from"./TrashIcon-Bnr7D0vo.js";import{_ as Oe}from"./VPageHeader.vue_vue_type_script_setup_true_lang-fmw-Xnf0.js";import{_ as Ne}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-DNp2ZTF-.js";import{r as Pe}from"./PlusIcon-DH-9V8Js.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./NoLayout.vue_vue_type_script_setup_true_lang-S_It9hZt.js";function Te(t,r){return g(),b("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[C("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"})])}function W(t,r){t===void 0&&(t={});const l={on:{}},d={},a={};N(l,re),l._emitClasses=!0,l.init=!1;const u={},i=H.map(e=>e.replace(/_/,"")),o=Object.assign({},t);return Object.keys(o).forEach(e=>{typeof t[e]>"u"||(i.indexOf(e)>=0?D(t[e])?(l[e]={},a[e]={},N(l[e],t[e]),N(a[e],t[e])):(l[e]=t[e],a[e]=t[e]):e.search(/on[A-Z]/)===0&&typeof t[e]=="function"?l.on[`${e[2].toLowerCase()}${e.substr(3)}`]=t[e]:u[e]=t[e])}),["navigation","pagination","scrollbar"].forEach(e=>{l[e]===!0&&(l[e]={}),l[e]===!1&&delete l[e]}),{params:l,passedParams:a,rest:u,events:d}}function $e(t,r){let{el:l,nextEl:d,prevEl:a,paginationEl:u,scrollbarEl:i,swiper:o}=t;q(r)&&d&&a&&(o.params.navigation.nextEl=d,o.originalParams.navigation.nextEl=d,o.params.navigation.prevEl=a,o.originalParams.navigation.prevEl=a),G(r)&&u&&(o.params.pagination.el=u,o.originalParams.pagination.el=u),K(r)&&i&&(o.params.scrollbar.el=i,o.originalParams.scrollbar.el=i),o.init(l)}function ze(t,r,l,d,a){const u=[];if(!r)return u;const i=e=>{u.indexOf(e)<0&&u.push(e)};if(l&&d){const e=d.map(a),f=l.map(a);e.join("")!==f.join("")&&i("children"),d.length!==l.length&&i("children")}return H.filter(e=>e[0]==="_").map(e=>e.replace(/_/,"")).forEach(e=>{if(e in t&&e in r)if(D(t[e])&&D(r[e])){const f=Object.keys(t[e]),s=Object.keys(r[e]);f.length!==s.length?i(e):(f.forEach(n=>{t[e][n]!==r[e][n]&&i(e)}),s.forEach(n=>{t[e][n]!==r[e][n]&&i(e)}))}else t[e]!==r[e]&&i(e)}),u}const je=t=>{!t||t.destroyed||!t.params.virtual||t.params.virtual&&!t.params.virtual.enabled||(t.updateSlides(),t.updateProgress(),t.updateSlidesClasses(),t.parallax&&t.params.parallax&&t.params.parallax.enabled&&t.parallax.setTranslate())};function V(t,r,l){t===void 0&&(t={});const d=[],a={"container-start":[],"container-end":[],"wrapper-start":[],"wrapper-end":[]},u=(i,o)=>{Array.isArray(i)&&i.forEach(e=>{const f=typeof e.type=="symbol";o==="default"&&(o="container-end"),f&&e.children?u(e.children,o):e.type&&(e.type.name==="SwiperSlide"||e.type.name==="AsyncComponentWrapper")||e.componentOptions&&e.componentOptions.tag==="SwiperSlide"?d.push(e):a[o]&&a[o].push(e)})};return Object.keys(t).forEach(i=>{if(typeof t[i]!="function")return;const o=t[i]();u(o,i)}),l.value=r.value,r.value=d,{slides:d,slots:a}}function Re(t,r,l){if(!l)return null;const d=s=>{let n=s;return s<0?n=r.length+s:n>=r.length&&(n=n-r.length),n},a=t.value.isHorizontal()?{[t.value.rtlTranslate?"right":"left"]:`${l.offset}px`}:{top:`${l.offset}px`},{from:u,to:i}=l,o=t.value.params.loop?-r.length:0,e=t.value.params.loop?r.length*2:r.length,f=[];for(let s=o;s<e;s+=1)s>=u&&s<=i&&f.length<r.length&&f.push(r[d(s)]);return f.map(s=>{if(s.props||(s.props={}),s.props.style||(s.props.style={}),s.props.swiperRef=t,s.props.style=a,s.type)return S(s.type,{...s.props},s.children);if(s.componentOptions)return S(s.componentOptions.Ctor,{...s.props},s.componentOptions.children)})}const Ie={name:"Swiper",props:{tag:{type:String,default:"div"},wrapperTag:{type:String,default:"div"},modules:{type:Array,default:void 0},init:{type:Boolean,default:void 0},direction:{type:String,default:void 0},oneWayMovement:{type:Boolean,default:void 0},swiperElementNodeName:{type:String,default:"SWIPER-CONTAINER"},touchEventsTarget:{type:String,default:void 0},initialSlide:{type:Number,default:void 0},speed:{type:Number,default:void 0},cssMode:{type:Boolean,default:void 0},updateOnWindowResize:{type:Boolean,default:void 0},resizeObserver:{type:Boolean,default:void 0},nested:{type:Boolean,default:void 0},focusableElements:{type:String,default:void 0},width:{type:Number,default:void 0},height:{type:Number,default:void 0},preventInteractionOnTransition:{type:Boolean,default:void 0},userAgent:{type:String,default:void 0},url:{type:String,default:void 0},edgeSwipeDetection:{type:[Boolean,String],default:void 0},edgeSwipeThreshold:{type:Number,default:void 0},autoHeight:{type:Boolean,default:void 0},setWrapperSize:{type:Boolean,default:void 0},virtualTranslate:{type:Boolean,default:void 0},effect:{type:String,default:void 0},breakpoints:{type:Object,default:void 0},breakpointsBase:{type:String,default:void 0},spaceBetween:{type:[Number,String],default:void 0},slidesPerView:{type:[Number,String],default:void 0},maxBackfaceHiddenSlides:{type:Number,default:void 0},slidesPerGroup:{type:Number,default:void 0},slidesPerGroupSkip:{type:Number,default:void 0},slidesPerGroupAuto:{type:Boolean,default:void 0},centeredSlides:{type:Boolean,default:void 0},centeredSlidesBounds:{type:Boolean,default:void 0},slidesOffsetBefore:{type:Number,default:void 0},slidesOffsetAfter:{type:Number,default:void 0},normalizeSlideIndex:{type:Boolean,default:void 0},centerInsufficientSlides:{type:Boolean,default:void 0},watchOverflow:{type:Boolean,default:void 0},roundLengths:{type:Boolean,default:void 0},touchRatio:{type:Number,default:void 0},touchAngle:{type:Number,default:void 0},simulateTouch:{type:Boolean,default:void 0},shortSwipes:{type:Boolean,default:void 0},longSwipes:{type:Boolean,default:void 0},longSwipesRatio:{type:Number,default:void 0},longSwipesMs:{type:Number,default:void 0},followFinger:{type:Boolean,default:void 0},allowTouchMove:{type:Boolean,default:void 0},threshold:{type:Number,default:void 0},touchMoveStopPropagation:{type:Boolean,default:void 0},touchStartPreventDefault:{type:Boolean,default:void 0},touchStartForcePreventDefault:{type:Boolean,default:void 0},touchReleaseOnEdges:{type:Boolean,default:void 0},uniqueNavElements:{type:Boolean,default:void 0},resistance:{type:Boolean,default:void 0},resistanceRatio:{type:Number,default:void 0},watchSlidesProgress:{type:Boolean,default:void 0},grabCursor:{type:Boolean,default:void 0},preventClicks:{type:Boolean,default:void 0},preventClicksPropagation:{type:Boolean,default:void 0},slideToClickedSlide:{type:Boolean,default:void 0},loop:{type:Boolean,default:void 0},loopedSlides:{type:Number,default:void 0},loopPreventsSliding:{type:Boolean,default:void 0},rewind:{type:Boolean,default:void 0},allowSlidePrev:{type:Boolean,default:void 0},allowSlideNext:{type:Boolean,default:void 0},swipeHandler:{type:Boolean,default:void 0},noSwiping:{type:Boolean,default:void 0},noSwipingClass:{type:String,default:void 0},noSwipingSelector:{type:String,default:void 0},passiveListeners:{type:Boolean,default:void 0},containerModifierClass:{type:String,default:void 0},slideClass:{type:String,default:void 0},slideActiveClass:{type:String,default:void 0},slideVisibleClass:{type:String,default:void 0},slideFullyVisibleClass:{type:String,default:void 0},slideBlankClass:{type:String,default:void 0},slideNextClass:{type:String,default:void 0},slidePrevClass:{type:String,default:void 0},wrapperClass:{type:String,default:void 0},lazyPreloaderClass:{type:String,default:void 0},lazyPreloadPrevNext:{type:Number,default:void 0},runCallbacksOnInit:{type:Boolean,default:void 0},observer:{type:Boolean,default:void 0},observeParents:{type:Boolean,default:void 0},observeSlideChildren:{type:Boolean,default:void 0},a11y:{type:[Boolean,Object],default:void 0},autoplay:{type:[Boolean,Object],default:void 0},controller:{type:Object,default:void 0},coverflowEffect:{type:Object,default:void 0},cubeEffect:{type:Object,default:void 0},fadeEffect:{type:Object,default:void 0},flipEffect:{type:Object,default:void 0},creativeEffect:{type:Object,default:void 0},cardsEffect:{type:Object,default:void 0},hashNavigation:{type:[Boolean,Object],default:void 0},history:{type:[Boolean,Object],default:void 0},keyboard:{type:[Boolean,Object],default:void 0},mousewheel:{type:[Boolean,Object],default:void 0},navigation:{type:[Boolean,Object],default:void 0},pagination:{type:[Boolean,Object],default:void 0},parallax:{type:[Boolean,Object],default:void 0},scrollbar:{type:[Boolean,Object],default:void 0},thumbs:{type:Object,default:void 0},virtual:{type:[Boolean,Object],default:void 0},zoom:{type:[Boolean,Object],default:void 0},grid:{type:[Object],default:void 0},freeMode:{type:[Boolean,Object],default:void 0},enabled:{type:Boolean,default:void 0}},emits:["_beforeBreakpoint","_containerClasses","_slideClass","_slideClasses","_swiper","_freeModeNoMomentumRelease","activeIndexChange","afterInit","autoplay","autoplayStart","autoplayStop","autoplayPause","autoplayResume","autoplayTimeLeft","beforeDestroy","beforeInit","beforeLoopFix","beforeResize","beforeSlideChangeStart","beforeTransitionStart","breakpoint","changeDirection","click","disable","doubleTap","doubleClick","destroy","enable","fromEdge","hashChange","hashSet","init","keyPress","lock","loopFix","momentumBounce","navigationHide","navigationShow","navigationPrev","navigationNext","observerUpdate","orientationchange","paginationHide","paginationRender","paginationShow","paginationUpdate","progress","reachBeginning","reachEnd","realIndexChange","resize","scroll","scrollbarDragEnd","scrollbarDragMove","scrollbarDragStart","setTransition","setTranslate","slidesUpdated","slideChange","slideChangeTransitionEnd","slideChangeTransitionStart","slideNextTransitionEnd","slideNextTransitionStart","slidePrevTransitionEnd","slidePrevTransitionStart","slideResetTransitionStart","slideResetTransitionEnd","sliderMove","sliderFirstMove","slidesLengthChange","slidesGridLengthChange","snapGridLengthChange","snapIndexChange","swiper","tap","toEdge","touchEnd","touchMove","touchMoveOpposite","touchStart","transitionEnd","transitionStart","unlock","update","virtualUpdate","zoomChange"],setup(t,r){let{slots:l,emit:d}=r;const{tag:a,wrapperTag:u}=t,i=v("swiper"),o=v(null),e=v(!1),f=v(!1),s=v(null),n=v(null),x=v(null),B={value:[]},O={value:[]},I=v(null),M=v(null),L=v(null),A=v(null),{params:E,passedParams:ae}=W(t);V(l,B,O),x.value=ae,O.value=B.value;const le=()=>{V(l,B,O),e.value=!0};E.onAny=function(m){for(var p=arguments.length,_=new Array(p>1?p-1:0),z=1;z<p;z++)_[z-1]=arguments[z];d(m,..._)},Object.assign(E.on,{_beforeBreakpoint:le,_containerClasses(m,p){i.value=p}});const U={...E};if(delete U.wrapperClass,n.value=new ue(U),n.value.virtual&&n.value.params.virtual.enabled){n.value.virtual.slides=B.value;const m={cache:!1,slides:B.value,renderExternal:p=>{o.value=p},renderExternalUpdate:!1};N(n.value.params.virtual,m),N(n.value.originalParams.virtual,m)}Z(()=>{!f.value&&n.value&&(n.value.emitSlidesClasses(),f.value=!0);const{passedParams:m}=W(t),p=ze(m,x.value,B.value,O.value,_=>_.props&&_.props.key);x.value=m,(p.length||e.value)&&n.value&&!n.value.destroyed&&fe({swiper:n.value,slides:B.value,passedParams:m,changedParams:p,nextEl:I.value,prevEl:M.value,scrollbarEl:A.value,paginationEl:L.value}),e.value=!1}),J("swiper",n),Q(o,()=>{pe(()=>{je(n.value)})}),X(()=>{s.value&&($e({el:s.value,nextEl:I.value,prevEl:M.value,paginationEl:L.value,scrollbarEl:A.value,swiper:n.value},E),d("swiper",n.value))}),Y(()=>{n.value&&!n.value.destroyed&&n.value.destroy(!0,!1)});function ie(m){return E.virtual?Re(n,m,o.value):(m.forEach((p,_)=>{p.props||(p.props={}),p.props.swiperRef=n,p.props.swiperSlideIndex=_}),m)}return()=>{const{slides:m,slots:p}=V(l,B,O);return S(a,{ref:s,class:ee(i.value)},[p["container-start"],S(u,{class:ce(E.wrapperClass)},[p["wrapper-start"],ie(m),p["wrapper-end"]]),q(t)&&[S("div",{ref:M,class:"swiper-button-prev"}),S("div",{ref:I,class:"swiper-button-next"})],K(t)&&S("div",{ref:A,class:"swiper-scrollbar"}),G(t)&&S("div",{ref:L,class:"swiper-pagination"}),p["container-end"]])}}},Me={name:"SwiperSlide",props:{tag:{type:String,default:"div"},swiperRef:{type:Object,required:!1},swiperSlideIndex:{type:Number,default:void 0,required:!1},zoom:{type:Boolean,default:void 0,required:!1},lazy:{type:Boolean,default:!1,required:!1},virtualIndex:{type:[String,Number],default:void 0}},setup(t,r){let{slots:l}=r,d=!1;const{swiperRef:a}=t,u=v(null),i=v("swiper-slide"),o=v(!1);function e(n,x,B){x===u.value&&(i.value=B)}X(()=>{!a||!a.value||(a.value.on("_slideClass",e),d=!0)}),ge(()=>{d||!a||!a.value||(a.value.on("_slideClass",e),d=!0)}),Z(()=>{!u.value||!a||!a.value||(typeof t.swiperSlideIndex<"u"&&(u.value.swiperSlideIndex=t.swiperSlideIndex),a.value.destroyed&&i.value!=="swiper-slide"&&(i.value="swiper-slide"))}),Y(()=>{!a||!a.value||a.value.off("_slideClass",e)});const f=ve(()=>({isActive:i.value.indexOf("swiper-slide-active")>=0,isVisible:i.value.indexOf("swiper-slide-visible")>=0,isPrev:i.value.indexOf("swiper-slide-prev")>=0,isNext:i.value.indexOf("swiper-slide-next")>=0}));J("swiperSlide",f);const s=()=>{o.value=!0};return()=>S(t.tag,{class:ee(`${i.value}`),ref:u,"data-swiper-slide-index":typeof t.virtualIndex>"u"&&a&&a.value&&a.value.params.loop?t.swiperSlideIndex:t.virtualIndex,onLoadCapture:s},t.zoom?S("div",{class:"swiper-zoom-container","data-swiper-zoom":typeof t.zoom=="number"?t.zoom:void 0},[l.default&&l.default(f.value),t.lazy&&!o.value&&S("div",{class:"swiper-lazy-preloader"})]):[l.default&&l.default(f.value),t.lazy&&!o.value&&S("div",{class:"swiper-lazy-preloader"})])}},Le=["src"],Ae={key:1,class:"flex aspect-video w-full items-center justify-center rounded-lg bg-neutral-100 md:rounded-xl"},Ve={class:"mt-4 flex items-start justify-between"},De={class:"relative"},Fe=["value"],Ue={key:0},ke={key:2,class:"mt-2 text-neutral-500"},We={key:3,class:"mt-2 text-neutral-500"},He=te({__name:"ClothingDetails",props:{clothing:{}},emits:["close"],setup(t,{emit:r}){const l=t,d=r,a=ne(),u={clickable:!0},i=me({clothes_category_id:l.clothing.clothes_category_id});Q(i,f=>{k.put(route("clothes.update",l.clothing),{clothes_category_id:f.clothes_category_id})});const o=v(!1),e=()=>{if(!o.value){o.value=!0;return}o.value=!1,k.delete(route("clothes.destroy",l.clothing)),d("close")};return(f,s)=>(g(),P(_e,{onClose:s[2]||(s[2]=n=>d("close"))},{default:h(()=>[f.clothing.imageUrls.length>0?(g(),P(c(Ie),{key:0,modules:[c(ye),c(he)],pagination:u,mousewheel:"",class:"rounded-lg md:rounded-xl"},{default:h(()=>[(g(!0),b(T,null,R(f.clothing.imageUrls,n=>(g(),P(c(Me),null,{default:h(()=>[C("img",{src:n,alt:"",class:"mx-auto rounded-lg md:rounded-xl"},null,8,Le)]),_:2},1024))),256))]),_:1},8,["modules"])):(g(),b("div",Ae,[y(c(de),{class:"mx-auto size-1/4 text-neutral-200"})])),C("div",Ve,[C("div",null,[y(c(Ce),{as:"h3",class:"text-xl font-medium leading-6 text-gray-900"},{default:h(()=>[$(w(f.$t("detail_du_vetement")),1)]),_:1}),C("label",De,[y(Be,{class:"mt-2"},{default:h(()=>[y(c(Ee),{class:"size-5"}),$(" "+w(c(a).name(c(i).clothes_category_id)),1)]),_:1}),be(C("select",{"onUpdate:modelValue":s[0]||(s[0]=n=>c(i).clothes_category_id=n),class:"absolute inset-0 opacity-0"},[(g(!0),b(T,null,R(c(a).options,n=>(g(),b("option",{value:n.value},w(n.label),9,Fe))),256))],512),[[Se,c(i).clothes_category_id]])])]),y(j,{onClick:e,variant:"danger",class:""},{default:h(()=>[y(c(xe),{class:"size-5"}),o.value?(g(),b("span",Ue," ("+w(f.$t("confirmer"))+") ",1)):F("",!0)]),_:1})]),f.clothing.description?(g(),b("p",ke,w(f.clothing.description),1)):f.clothing.imageUrls.length===0?(g(),b("p",We,w(f.$t("aucune_description")),1)):F("",!0),y(j,{onClick:s[1]||(s[1]=n=>d("close")),variant:"tertiary",class:"mt-4 w-full max-w-sm"},{default:h(()=>[$(w(f.$t("fermer")),1)]),_:1})]),_:1}))}}),qe={class:"mt-4"},Ge={class:"text-xl"},Ke={class:"mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8"},rt=te({__name:"Show",props:{dressing:{},clothesByCategory:{}},setup(t){const r=v(null),l=ne();return(d,a)=>(g(),b(T,null,[y(c(we),{title:d.$t("dashboard")},null,8,["title"]),y(Ne,null,{header:h(()=>[y(Oe,{"back-to":d.route("dashboard"),title:d.$t("dressing_name",{name:d.dressing.name})},{default:h(()=>[y(j,{href:d.route("dressings.clothes.create",d.dressing)},{default:h(()=>[y(c(Pe),{class:"size-5"}),$(" "+w(d.$t("vtement")),1)]),_:1},8,["href"]),y(j,{href:d.route("dressings.edit",d.dressing),variant:"secondary"},{default:h(()=>[y(c(Te),{class:"size-5"}),$(" "+w(d.$t("modifier")),1)]),_:1},8,["href"])]),_:1},8,["back-to","title"])]),default:h(()=>[(g(!0),b(T,null,R(d.clothesByCategory,(u,i)=>(g(),b("section",qe,[C("h3",Ge,w(c(l).name(i))+" ("+w(u.length)+") ",1),C("div",Ke,[(g(!0),b(T,null,R(u,o=>(g(),P(se,{class:"w-32 shrink-0","sr-text":d.$t("voir_le_dtail"),onClick:e=>r.value=o},{default:h(()=>[y(oe,{clothing:o},null,8,["clothing"])]),_:2},1032,["sr-text","onClick"]))),256))])]))),256)),r.value?(g(),P(He,{key:0,clothing:r.value,onClose:a[0]||(a[0]=u=>r.value=null)},null,8,["clothing"])):F("",!0)]),_:1})],64))}});export{rt as default};