import React from "react";
import Rating from "./common/rating";

function Job(props) {
  return (
    <div className="job">
      <div className="job__header">
        <p className="text-3xl">Title</p>
      </div>
      <div className="job__rating">
        <Rating value={10} />
      </div>
      <div className="job__body">{props.children}</div>
    </div>
  );
}

export default Job;
