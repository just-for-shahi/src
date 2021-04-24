import React, { useState, useEffect } from "react";
import _ from "lodash";
import { typeIcon } from "../../Enum";


export default function CardIcon({ data,handleClickCategory }) {
    const [ icon, setIcon ] = useState('');
  
    useEffect(() => {
        getDetails();
    }, []);

    const getDetails = () =>{
        _.get(_.find(typeIcon, function(obj){
            if(obj.type === data.type) {
                setIcon(obj.icon);
            }
        }))
    }
   
    const style = `fas ${icon} icon-size-md color-secondary`;
    return (
            <div className="card border-0 single-promo-card p-2 mt-4 shadow" onClick={()=>handleClickCategory(data)}>
                <div className="card-body">
                    <div className="pb-2">
                        <span className={style} />
                    </div>
                    <div className="pt-2 pb-3">
                        {data && <h5>{_.get(data, "title")}</h5>}
                        <p className="mb-0">{_.get(data, "description","دوره‌های آموزشی در بیش از ۳۱ دسته‌بندی مختلف.")}</p>
                    </div>
                </div>
            </div>
    )
}