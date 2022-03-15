import React from "react";
import Info from "./common/info";
import Rating from "./common/rating";

function Job(props) {
  return (
    <div className="job">
      <div className="mb-3">
        <p className="job__title">
          Contract PHP Developer with React Experience
        </p>
      </div>
      <div className="mb-3">
        <Rating value={10} />
      </div>
      <div className="job__info mb-2">
        <Info label="Rate" value="£300 - £400" />
      </div>
      <div className="job__info-sub mb-8">
        <Info label="Length" value="6 Months" />
        <Info label="IR35" value="Outside" />
        <Info label="Remote" value="Yes" />
      </div>
      <div className="flex">
        <button className="button flex-1 mr-2">Dismiss</button>
        <button className="button flex-1 is-pink">View</button>
      </div>
    </div>
  );
}

export default Job;
