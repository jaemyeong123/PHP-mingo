import React from 'react';
import queryString from 'query-string';

import starbucks from '../images/starbucks.png';
import baekdabang from '../images/baekdabang.png';
import coffeebean from '../images/coffeebean.png';
import ediya from '../images/ediya.png';
import head_btn_go from '../images/head_btn_go.png';

import common from '../css/style.css';
import styles from '../css/style.css';

const About = ({location, match}) => {
    const query = queryString.parse(location.search);
    return (
        <ul className="wallet_ul">
          <li>
            <div className="wallet_div_1">
              <img className="" src={starbucks}></img>
            </div>
            <div className="wallet_div_2">
              <span className="cafe_name">스타벅스 샤로수길점</span>
            </div>
            <div className="wallet_div_3">
              <img className="" src={head_btn_go}></img>
            </div>
          </li>
          <li>
            <div className="wallet_div_1">
              <img className="" src={baekdabang}></img>
            </div>
            <div className="wallet_div_2">
              <span className="cafe_name">백다방 경희대점</span>
            </div>
            <div className="wallet_div_3">
              <img className="" src={head_btn_go}></img>
            </div>
          </li>
          <li>
            <div className="wallet_div_1">
              <img className="" src={coffeebean}></img>
            </div>
            <div className="wallet_div_2">
              <span className="cafe_name">커피빈 회기점</span>
            </div>
            <div className="wallet_div_3">
              <img className="" src={head_btn_go}></img>
            </div>
          </li>
          <li>
            <div className="wallet_div_1">
              <img className="" src={ediya}></img>
            </div>
            <div className="wallet_div_2">
              <span className="cafe_name">이디야 가산디지털단지점</span>
            </div>
            <div className="wallet_div_3">
              <img className="" src={head_btn_go}></img>
            </div>
          </li>

          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
        </ul>
    );
};


export default About;
