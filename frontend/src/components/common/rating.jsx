import React from "react";

function Rating(props) {
  const rating = props.value;
  const colors = {
    0: "#ef4444",
    1: "#f26440",
    2: "#f5843c",
    3: "#f8ac37",
    4: "#fcd731",
    5: "#fff72d",
    6: "#e4ee28",
    7: "#cbe523",
    8: "#b0dc1e",
    9: "#98d31a",
    10: "#84cc16",
  };

  const color = colors[Math.round(rating)];

  return (
    <div className="rating">
      <p
        className="rating__badge mr-2"
        style={{ borderColor: color, color: color }}
      >
        {rating}
      </p>
      <div className="rating__bar">
        <div
          className="rating__bar-inner"
          style={{
            width: rating * 10 + "%",
            backgroundColor: color,
          }}
        ></div>
      </div>
    </div>
  );
}

export default Rating;
