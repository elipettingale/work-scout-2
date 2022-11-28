import React, { Component } from "react";
import Result from "./result";
import _ from "lodash";
import {
  dismissResult,
  getResults,
  getResult,
} from "../services/resultService";
import { highlightKeywords, getScore } from "../helpers/keywords";

class Results extends Component {
  state = {
    results: [],
    activeResult: "",
  };

  componentDidMount = async () => {
    const { data: results } = await getResults();

    results.forEach((result) => {
      result.score = getScore(result.description);
    });

    if (results.length > 0) {
      this.setState({
        results: results,
        activeResult: results[0],
      });
    }

    window.Echo.channel("results").listen("ResultCreated", async (e) => {
      const { data: result } = await getResult(e.id);
      result.score = getScore(result.description);

      const results = [result, ...this.state.results];

      this.setState({
        results: results,
        activeResult: results[0],
      });
    });
  };

  handleDismissResult = async (result) => {
    const previousResults = [...this.state.results];

    const results = [...this.state.results];
    _.remove(results, result);

    this.setState({
      results: results,
      activeResult: results[0] ? results[0] : "",
    });

    try {
      await dismissResult(result);
    } catch (ex) {
      this.setState({
        results: previousResults,
        activeResult: previousResults[0],
      });
    }
  };

  setActiveResult = (result) => {
    this.setState({
      activeResult: result,
    });
  };

  render() {
    return (
      <div className="flex">
        <div className="flex-1 h-screen p-8 overflow-scroll results ">
          <div className="max-w-2xl ml-auto">
            {this.state.results.map((result) => (
              <Result
                key={result.id}
                data={result}
                isActive={result === this.state.activeResult}
                onClick={() => this.setActiveResult(result)}
              />
            ))}
          </div>
        </div>
        <div className="flex-1 bg-white h-screen p-8 overflow-scroll">
          <div className="max-w-2xl mr-auto">{this.renderPane()}</div>
        </div>
      </div>
    );
  }

  renderPane() {
    const { activeResult: result } = this.state;
    if (result === "") return;

    return (
      <Result key={result.id} data={result}>
        <div className="flex mt-8">
          <button
            className="button flex-1 mr-2"
            onClick={() => this.handleDismissResult(result)}
          >
            Dismiss
          </button>
          <a
            href={result.url}
            target="_blank"
            className="button flex-1 is-pink"
          >
            Apply
          </a>
        </div>
        {this.renderDescription(result)}
      </Result>
    );
  }

  renderDescription(result) {
    let { description } = result;
    description = highlightKeywords(description);

    return (
      <div
        className="mt-8"
        dangerouslySetInnerHTML={{ __html: description }}
      ></div>
    );
  }
}

export default Results;
