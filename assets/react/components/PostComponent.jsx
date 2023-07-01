import React from "react";
import {createRoot} from "react-dom/client"
function Post(){
    return <h2>Post components</h2>
}
class PostComponent extends HTMLElement {
    connectedCallback(){
        const root = createRoot(this)
        root.render(<Post/>)
    }
}
 
customElements.define('post-component',PostComponent)