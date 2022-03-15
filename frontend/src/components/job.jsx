import React from "react";
import Info from "./common/info";
import Rating from "./common/rating";

function Job(props) {
  const { title, rating, info } = props.data;

  return (
    <div className="job">
      <div className="mb-3">
        <p className="job__title">{title}</p>
      </div>
      <div className="mb-3">
        <Rating value={rating} />
      </div>
      <div className="job__info mb-2">
        <Info label="Rate" value={info.rate} />
      </div>
      <div className="job__info-sub mb-8">
        <Info label="Length" value={info.length} />
        <Info label="IR35" value={info.ir35} />
        <Info label="Remote" value={info.remote} />
      </div>
      <div className="flex">
        <button className="button flex-1 mr-2">Dismiss</button>
        <button className="button flex-1 is-pink">View</button>
      </div>
    </div>
  );
}

export default Job;
