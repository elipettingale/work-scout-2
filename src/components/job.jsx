import React from "react";
import Info from "./common/info";
import Rating from "./common/rating";

function Job(props) {
  return (
    <div className="job">
      <div className="mb-2">
        <p className="text-3xl">Title</p>
      </div>
      <div className="mb-2">
        <Rating value={10} />
      </div>
      <div className="job__info mb-8">
        <Info label="IR35" value="Outside" />
        <Info label="Rate" value="£400" />
      </div>
      <div className="flex">
        <button className="button flex-1 mr-2">Dismiss</button>
        <button className="button flex-1 is-pink">View</button>
      </div>
    </div>
  );
}

export default Job;
