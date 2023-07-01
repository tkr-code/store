import React from 'react';
import { useState } from 'react';
export default function (props) {
    const [title, setTitle] = useState("")
    const [errorTitle, setErrorTitle] = useState("")

    return (
    <div>
        <div className="form-group">
          <input type="text" value={title} onChange={(title)=> setTitle(title.target.value) }  className="form-control" placeholder="Ajouter une categorie" aria-describedby="helpId"/>
          <small id="titleHelp" className="text-muted">{errorTitle}</small>
        </div>
    </div>);
}