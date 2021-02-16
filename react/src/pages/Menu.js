import React from 'react';
import { Link } from 'react-router-dom';
import menu_1 from '../images/menu_1.png';
import menu_2 from '../images/menu_2.png';
import menu_3 from '../images/menu_3.png';
import menu_4 from '../images/menu_4.png';
import menu_5 from '../images/menu_5.png';



const Menu = () => {
    return (
        <footer>
            <ul>
              <li className="active">
                <Link to="/home:home">
                  <span><img src={menu_1} /></span>홈
                </Link>
              </li>
              <li >
                <Link to="/wallet:wallet">
                  <span><img src={menu_2} /></span>내 지갑
                </Link>
              </li>
              <li >
                <Link to="/qrcode:qrcode">
                  <span><img src={menu_3} /></span>QR코드
                </Link>
              </li>
              <li >
                <Link to="/search:search">
                  <span><img src={menu_4} /></span>주변 카페
                </Link>
              </li>
              <li >
                <Link to="/more:more">
                  <span><img src={menu_5} /></span>더보기
                </Link>
              </li>
            </ul>
        </footer>
    );
};

export default Menu;
