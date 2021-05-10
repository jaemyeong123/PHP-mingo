import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import { Home, About, Menu, Wallet, VerticalPopup } from '../pages';
import { Test } from '../components';
import axios from 'axios';


import { TransitionGroup, CSSTransition } from "react-transition-group";
import common from '../css/style.css';
import styles from '../css/style.css';


class App extends Component {
  state = {
    modal_show:"hide"
  }
  
  modal_open_login = () => {
    this.setState({
      modal_show:"show"
    })
  }

  modal_close_login = () => {
    this.setState({
      modal_show:"hide"
    })
  }

  render() {
    const tempStyle={
      "textAlign": "center",
      "padding": "20px",
    }

    function fetchData(){
      const result = axios.get('http://api.mingo.pe.kr/notice_v_1_0_0/notice_list?notice_type=0&page_num=1'
      ,).then(function(data) {
        {/*console.log(data.data.data_array);*/}
        let api_data = data.data.data_array;
        const noticeList = api_data.map(
          (data_obj) => ( <li>{data_obj.notice_idx} : {data_obj.title}</li> )
        );
        {/*console.log(noticeList);*/}
      });
    }
    fetchData();

    var QRCode = require('qrcode.react');

    return (
      <div>
        {/* 리액트 주석 방법 */}
        <Route //리액투 주석
          render={
            ({ location }) => {
              return (
                <TransitionGroup className="transition-group" >
                  <CSSTransition
                    key={location.key}
                    timeout={{ enter: 300, exit: 300 }}
                    classNames="fade"
                  >
                    <section className="route-section">
                      <div>
                        <h1 style={tempStyle} className="project_name">리액트 토이프로젝트</h1>
                        <button onClick={()=>this.modal_open_login()}>modal_show</button>
                        <button onClick={()=>this.modal_close_login()}>modal_hide</button>
                        <div style={{"padding":"30px", "margin":"20px auto", "maxWidth":"200px", "maxHeight":"200px"}}>
                          <QRCode style={{"width":"100%", "height":"100%"}} value="http://facebook.github.io/react/" />
                        </div>
                        <Test></Test>
                        <div style={{"width":"100%", "height":"300px", "backgroundColor":"#B18904", "zIndex":"1"}}></div>

                        <div style={{"padding":"10px"}}>
                          <Route exact path="/" component={Home}/>
                          <Switch location={location}>
                              <Route path="/home:name" component={About}/>
                              <Route path="/wallet:name" component={Wallet}/>
                              <Route path="/qrcode:name" component={About}/>
                              <Route path="/search:name" component={About}/>
                              <Route path="/more:name" component={About}/>
                          </Switch>
                        </div>
                        <Menu></Menu>
                      </div>
                    </section>
                  </CSSTransition>
                </TransitionGroup>
              );
            }
          }
        >
        </Route>
        <VerticalPopup/>
      </div>



    );
  }
}

export default App;
