import{_ as de}from"./VButton.vue_vue_type_script_setup_true_lang-D51bOqsU.js";import{a as T,c as A,h as M,g as K,o as P,O as ne,r as k,ad as ae,A as F,ae as pe,af as ve,a6 as re,a3 as W,ag as me,l as _,ah as ye,d as Q,f as B,i as ge,t as he,e as we,n as Y,a8 as Se,b as ee,F as _e,s as be,k as se,a4 as Te,q as G}from"./app-Dx26qlXV.js";function ke(e,t){return T(),A("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[M("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"})])}function xe(e,t){return T(),A("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[M("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18 18 6M6 6l12 12"})])}function Z(e){return pe()?(ve(e),!0):!1}function D(e){return typeof e=="function"?e():K(e)}const ie=typeof window<"u"&&typeof document<"u";typeof WorkerGlobalScope<"u"&&globalThis instanceof WorkerGlobalScope;const Ae=Object.prototype.toString,oe=e=>Ae.call(e)==="[object Object]",Fe=()=>{};function Oe(e,t){function n(...s){return new Promise((i,r)=>{Promise.resolve(e(()=>t.apply(this,s),{fn:t,thisArg:this,args:s})).then(i).catch(r)})}return n}const le=e=>e();function Ee(e=le){const t=k(!0);function n(){t.value=!1}function s(){t.value=!0}const i=(...r)=>{t.value&&e(...r)};return{isActive:ae(t),pause:n,resume:s,eventFilter:i}}function Me(e){let t;function n(){return t||(t=e()),t}return n.reset=async()=>{const s=t;t=void 0,s&&await s},n}function Re(e,t,n=!1){return Object.fromEntries(Object.entries(e).filter(([s,i])=>(!n||i!==void 0)&&!t.includes(s)))}function Ce(e){return re()}function Ne(e,t,n={}){const{eventFilter:s=le,...i}=n;return F(e,Oe(s,t),i)}function De(e,t,n={}){const{eventFilter:s,...i}=n,{eventFilter:r,pause:f,resume:d,isActive:m}=Ee(s);return{stop:Ne(e,t,{...i,eventFilter:r}),pause:f,resume:d,isActive:m}}function ue(e,t=!0,n){Ce()?P(e,n):t?e():ne(e)}const j=ie?window:void 0,ce=ie?window.navigator:void 0;function N(e){var t;const n=D(e);return(t=n==null?void 0:n.$el)!=null?t:n}function R(...e){let t,n,s,i;if(typeof e[0]=="string"||Array.isArray(e[0])?([n,s,i]=e,t=j):[t,n,s,i]=e,!t)return Fe;Array.isArray(n)||(n=[n]),Array.isArray(s)||(s=[s]);const r=[],f=()=>{r.forEach(p=>p()),r.length=0},d=(p,c,g,a)=>(p.addEventListener(c,g,a),()=>p.removeEventListener(c,g,a)),m=F(()=>[N(t),D(i)],([p,c])=>{if(f(),!p)return;const g=oe(c)?{...c}:c;r.push(...n.flatMap(a=>s.map(l=>d(p,a,l,g))))},{immediate:!0,flush:"post"}),v=()=>{m(),f()};return Z(v),v}function je(){const e=k(!1),t=re();return t&&P(()=>{e.value=!0},t),e}function X(e){const t=je();return _(()=>(t.value,!!e()))}function $e(e,t={}){const{immediate:n=!0,fpsLimit:s=void 0,window:i=j}=t,r=k(!1),f=s?1e3/s:null;let d=0,m=null;function v(g){if(!r.value||!i)return;d||(d=g);const a=g-d;if(f&&a<f){m=i.requestAnimationFrame(v);return}d=g,e({delta:a,timestamp:g}),m=i.requestAnimationFrame(v)}function p(){!r.value&&i&&(r.value=!0,d=0,m=i.requestAnimationFrame(v))}function c(){r.value=!1,m!=null&&i&&(i.cancelAnimationFrame(m),m=null)}return n&&p(),Z(c),{isActive:ae(r),pause:c,resume:p}}function ze(e,t,n){let s,i;oe(n)?(s=n,i=Re(n,["window","immediate","commitStyles","persist","onReady","onError"])):(s={duration:n},i=n);const{window:r=j,immediate:f=!0,commitStyles:d,persist:m,playbackRate:v=1,onReady:p,onError:c=o=>{console.error(o)}}=s,g=X(()=>r&&HTMLElement&&"animate"in HTMLElement.prototype),a=W(void 0),l=me({startTime:null,currentTime:null,timeline:null,playbackRate:v,pending:!1,playState:f?"idle":"paused",replaceState:"active"}),S=_(()=>l.pending),w=_(()=>l.playState),C=_(()=>l.replaceState),x=_({get(){return l.startTime},set(o){l.startTime=o,a.value&&(a.value.startTime=o)}}),J=_({get(){return l.currentTime},set(o){l.currentTime=o,a.value&&(a.value.currentTime=o,L())}}),$=_({get(){return l.timeline},set(o){l.timeline=o,a.value&&(a.value.timeline=o)}}),z=_({get(){return l.playbackRate},set(o){l.playbackRate=o,a.value&&(a.value.playbackRate=o)}}),I=()=>{if(a.value)try{a.value.play(),L()}catch(o){E(),c(o)}else y()},H=()=>{var o;try{(o=a.value)==null||o.pause(),E()}catch(b){c(b)}},O=()=>{var o;a.value||y();try{(o=a.value)==null||o.reverse(),L()}catch(b){E(),c(b)}},U=()=>{var o;try{(o=a.value)==null||o.finish(),E()}catch(b){c(b)}},u=()=>{var o;try{(o=a.value)==null||o.cancel(),E()}catch(b){c(b)}};F(()=>N(e),o=>{o&&y()}),F(()=>t,o=>{a.value&&y(),!N(e)&&a.value&&(a.value.effect=new KeyframeEffect(N(e),D(o),i))},{deep:!0}),ue(()=>y(!0),!1),Z(u);function y(o){const b=N(e);!g.value||!b||(a.value||(a.value=b.animate(D(t),i)),m&&a.value.persist(),v!==1&&(a.value.playbackRate=v),o&&!f?a.value.pause():L(),p==null||p(a.value))}R(a,["cancel","finish","remove"],E),R(a,"finish",()=>{var o;d&&((o=a.value)==null||o.commitStyles())});const{resume:h,pause:fe}=$e(()=>{a.value&&(l.pending=a.value.pending,l.playState=a.value.playState,l.replaceState=a.value.replaceState,l.startTime=a.value.startTime,l.currentTime=a.value.currentTime,l.timeline=a.value.timeline,l.playbackRate=a.value.playbackRate)},{immediate:!1});function L(){g.value&&h()}function E(){g.value&&r&&r.requestAnimationFrame(fe)}return{isSupported:g,animate:a,play:I,pause:H,reverse:O,finish:U,cancel:u,pending:S,playState:w,replaceState:C,startTime:x,currentTime:J,timeline:$,playbackRate:z}}function Le(e,t={}){const{controls:n=!1,navigator:s=ce}=t,i=X(()=>s&&"permissions"in s),r=W(),f={name:e},d=W(),m=()=>{var p,c;d.value=(c=(p=r.value)==null?void 0:p.state)!=null?c:"prompt"};R(r,"change",m);const v=Me(async()=>{if(i.value){if(!r.value)try{r.value=await s.permissions.query(f)}catch{r.value=void 0}finally{m()}if(n)return ye(r.value)}});return v(),n?{state:d,isSupported:i,query:v}:d}const V=typeof globalThis<"u"?globalThis:typeof window<"u"?window:typeof global<"u"?global:typeof self<"u"?self:{},q="__vueuse_ssr_handlers__",Ve=qe();function qe(){return q in V||(V[q]=V[q]||{}),V[q]}function Be(e,t){return Ve[e]||t}function We(e){return e==null?"any":e instanceof Set?"set":e instanceof Map?"map":e instanceof Date?"date":typeof e=="boolean"?"boolean":typeof e=="string"?"string":typeof e=="object"?"object":Number.isNaN(e)?"any":"number"}const Pe={boolean:{read:e=>e==="true",write:e=>String(e)},object:{read:e=>JSON.parse(e),write:e=>JSON.stringify(e)},number:{read:e=>Number.parseFloat(e),write:e=>String(e)},any:{read:e=>e,write:e=>String(e)},string:{read:e=>e,write:e=>String(e)},map:{read:e=>new Map(JSON.parse(e)),write:e=>JSON.stringify(Array.from(e.entries()))},set:{read:e=>new Set(JSON.parse(e)),write:e=>JSON.stringify(Array.from(e))},date:{read:e=>new Date(e),write:e=>e.toISOString()}},te="vueuse-storage";function tt(e,t,n,s={}){var i;const{flush:r="pre",deep:f=!0,listenToStorageChanges:d=!0,writeDefaults:m=!0,mergeDefaults:v=!1,shallow:p,window:c=j,eventFilter:g,onError:a=u=>{console.error(u)},initOnMounted:l}=s,S=(p?W:k)(typeof t=="function"?t():t);if(!n)try{n=Be("getDefaultStorage",()=>{var u;return(u=j)==null?void 0:u.localStorage})()}catch(u){a(u)}if(!n)return S;const w=D(t),C=We(w),x=(i=s.serializer)!=null?i:Pe[C],{pause:J,resume:$}=De(S,()=>I(S.value),{flush:r,deep:f,eventFilter:g});c&&d&&ue(()=>{n instanceof Storage?R(c,"storage",O):R(c,te,U),l&&O()}),l||O();function z(u,y){if(c){const h={key:e,oldValue:u,newValue:y,storageArea:n};c.dispatchEvent(n instanceof Storage?new StorageEvent("storage",h):new CustomEvent(te,{detail:h}))}}function I(u){try{const y=n.getItem(e);if(u==null)z(y,null),n.removeItem(e);else{const h=x.write(u);y!==h&&(n.setItem(e,h),z(y,h))}}catch(y){a(y)}}function H(u){const y=u?u.newValue:n.getItem(e);if(y==null)return m&&w!=null&&n.setItem(e,x.write(w)),w;if(!u&&v){const h=x.read(y);return typeof v=="function"?v(h,w):C==="object"&&!Array.isArray(h)?{...w,...h}:h}else return typeof y!="string"?y:x.read(y)}function O(u){if(!(u&&u.storageArea!==n)){if(u&&u.key==null){S.value=w;return}if(!(u&&u.key!==e)){J();try{(u==null?void 0:u.newValue)!==x.write(S.value)&&(S.value=H(u))}catch(y){a(y)}finally{u?ne($):$()}}}}function U(u){O(u.detail)}return S}function nt(e={}){const{navigator:t=ce,requestPermissions:n=!1,constraints:s={audio:!0,video:!0},onUpdated:i}=e,r=k([]),f=_(()=>r.value.filter(l=>l.kind==="videoinput")),d=_(()=>r.value.filter(l=>l.kind==="audioinput")),m=_(()=>r.value.filter(l=>l.kind==="audiooutput")),v=X(()=>t&&t.mediaDevices&&t.mediaDevices.enumerateDevices),p=k(!1);let c;async function g(){v.value&&(r.value=await t.mediaDevices.enumerateDevices(),i==null||i(r.value),c&&(c.getTracks().forEach(l=>l.stop()),c=null))}async function a(){if(!v.value)return!1;if(p.value)return!0;const{state:l,query:S}=Le("camera",{controls:!0});if(await S(),l.value!=="granted"){let w=!0;try{c=await t.mediaDevices.getUserMedia(s)}catch{c=null,w=!1}g(),p.value=w}else p.value=!0;return p.value}return v.value&&(n&&a(),R(t.mediaDevices,"devicechange",g),g()),{devices:r,ensurePermissions:a,permissionGranted:p,videoInputs:f,audioInputs:d,audioOutputs:m,isSupported:v}}const Je={class:"absolute bottom-0 left-0 right-0"},Ie=2e3,He=Q({__name:"VToast",props:{type:{},content:{}},emits:["close"],setup(e,{emit:t}){const n=t,s=k(),{play:i,playState:r}=ze(s,{width:0},{immediate:!1,duration:Ie});return F(r,f=>{f==="finished"&&n("close")}),P(()=>{i()}),(f,d)=>(T(),A("div",{class:Y(["relative flex max-w-lg items-center gap-2 overflow-hidden rounded-lg px-4 py-2 shadow-lg",{"bg-green-100 text-green-900":f.type==="success","bg-red-100 text-red-900":f.type==="error"}])},[B(K(ke),{class:"size-7"}),ge(" "+he(f.content)+" ",1),B(de,{class:"ml-auto after:absolute after:inset-0",icon:"",small:"",variant:"ghost",onClick:d[0]||(d[0]=m=>n("close"))},{default:we(()=>[B(K(xe),{class:Y(["size-5",{"text-green-900":f.type==="success","text-red-900":f.type==="error"}])},null,8,["class"])]),_:1}),M("div",Je,[M("div",{ref_key:"progressBar",ref:s,class:"h-0.5 w-full bg-green-800"},null,512)])],2))}}),Ue={key:0,class:"fixed left-4 right-4 top-4 z-50 flex flex-col items-center gap-2"},Ge=Q({__name:"FlashedMessages",setup(e){const t=Se(),n=k(new Map),s=(r,f)=>{r&&n.value.set(r.id,{type:"success",content:r.content})},i=r=>{n.value.delete(r)};return P(()=>{s(t.props.flash.success),s(t.props.flash.error)}),F(()=>t.props.flash.success,r=>{s(r)}),F(()=>t.props.flash.error,r=>{s(r)}),(r,f)=>(T(),ee(Te,{to:"body"},[n.value.size?(T(),A("div",Ue,[(T(!0),A(_e,null,be(n.value.entries(),([d,m])=>(T(),ee(He,{key:d,content:m.content,type:m.type,onClose:v=>i(d)},null,8,["content","type","onClose"]))),128))])):se("",!0)]))}}),Ke={class:"relative flex min-h-dvh flex-col"},Qe={key:0,class:"sticky top-0 z-30 border-b bg-white"},Ze={class:"mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"},Xe={class:"mx-auto flex h-full w-full max-w-7xl grow flex-col px-4 py-6 sm:px-6 lg:px-8"},at=Q({__name:"NoLayout",setup(e){return(t,n)=>(T(),A("div",Ke,[t.$slots.header?(T(),A("header",Qe,[M("div",Ze,[G(t.$slots,"header")])])):se("",!0),M("div",Xe,[G(t.$slots,"default")]),G(t.$slots,"footer"),B(Ge)]))}});export{at as _,tt as a,xe as b,ke as r,nt as u};