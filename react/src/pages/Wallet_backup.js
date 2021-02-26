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
            <span className="wallet_img_area">
              <img className="" src={starbucks}></img>
            </span>
            <span className="cafe_name">스타벅스 샤로수길점</span>
            <span className="head_btn_go">
              <img className="" src={head_btn_go}></img>
            </span>
          </li>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <br></br>
          <li>
            <div>
              <img src={baekdabang}></img>
            </div>
            <p>백다방 경희대점</p>
            <img src={head_btn_go}></img>
          </li>
          <li>
            <div>
              <img src={coffeebean}></img>
            </div>
            <p>커피빈 회기점</p>
            <img src={head_btn_go}></img>
          </li>
          <li>
            <div>
              <img src={ediya}></img>
            </div>
            <p>이디야 가산디지털단지점</p>
            <img src={head_btn_go}></img>
          </li>
        </ul>
    );
};


export default About;
