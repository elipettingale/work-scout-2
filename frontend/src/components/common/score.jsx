import React from "react";

function Score({ value: score }) {
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

  const color = colors[Math.round(score)];

  return (
    <div className="score">
      <p
        className="score__badge mr-3"
        style={{ borderColor: color, color: color }}
      >
        {score}
      </p>
      <div className="score__bar">
        <div
          className="score__bar-inner"
          style={{
            width: score * 10 + "%",
            backgroundColor: color,
          }}
        ></div>
      </div>
    </div>
  );
}

export default Score;
