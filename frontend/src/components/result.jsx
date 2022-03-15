import React from "react";
import Info from "./common/info";
import Score from "./common/score";

function Result(props) {
  const { title, rate, length, ir35, remote, description, score } = props.data;

  return (
    <div className="result">
      <div className="mb-3">
        <p className="result__title">{title}</p>
      </div>
      <div className="mb-3">
        <Score value={score} />
      </div>
      <div className="result__info mb-2">
        <Info label="Rate" value={rate} />
      </div>
      <div className="result__info-sub">
        <Info label="Length" value={length} />
        <Info label="IR35" value={ir35} />
        <Info label="Remote" value={remote} />
      </div>
      {props.children}
    </div>
  );
}

export default Result;
