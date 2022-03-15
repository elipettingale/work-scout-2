import React from "react";
import Info from "./common/info";
import Score from "./common/score";

function Job(props) {
  const { title, rate, length, ir35, remote, description, score } = props.data;

  return (
    <div className="job">
      <div className="mb-3">
        <p className="job__title">{title}</p>
      </div>
      <div className="mb-3">
        <Score value={score} />
      </div>
      <div className="job__info mb-2">
        <Info label="Rate" value={rate} />
      </div>
      <div className="job__info-sub mb-8">
        <Info label="Length" value={length} />
        <Info label="IR35" value={ir35} />
        <Info label="Remote" value={remote} />
      </div>
      <div className="flex">{props.children}</div>
    </div>
  );
}

export default Job;
