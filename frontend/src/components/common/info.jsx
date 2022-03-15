import React from "react";

function Info(props) {
  return (
    <div className="info">
      <p className="info__label">{props.label}</p>
      <p className="info__value">{props.value}</p>
    </div>
  );
}

export default Info;
