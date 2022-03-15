import React from "react";

function Info({ label, value }) {
  return (
    <div className="info">
      <p className="info__label">{label}</p>
      <p className="info__value">{value}</p>
    </div>
  );
}

export default Info;
