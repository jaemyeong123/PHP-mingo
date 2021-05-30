import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import { Home, About, Menu, Wallet, VerticalPopup } from '../pages';
import { Test } from '../components';
import axios from 'axios';
import firebase from 'firebase'; //firebase모듈을 import해줘야 합니다.
import request from 'request';

import { TransitionGroup, CSSTransition } from "react-transition-group";
import common from '../css/style.css';
import styles from '../css/style.css';


var firebaseConfig = {
  apiKey: "AAAAHkF0Xww:APA91bHRPxHCNrvy-D578fD7G7SYlPJeTov3O-DHHaytWYNQ57XCpoDotHTAi_LJ7bE3nyLdIHFi6CbRq_aHwG-ZkQStMjwpa4kVRH2kmdWqE-evmFX-fPM0eyyAP8yfL0wSHa8Wx-_J",
  authDomain: "php-mingo.firebaseapp.com",
  projectId: "php-mingo",
  storageBucket: "php-mingo.appspot.com",
  messagingSenderId: "129947164428",
  appId: "1:129947164428:web:47f4a4ebcaa1d2b13a3329",
  measurementId: "G-HKBTF5BGJL"
};
// Initialize Firebase

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

//허가를 요청합니다!
messaging.requestPermission()
.then(function() {
	console.log('허가!');
	return messaging.getToken(); //토큰을 받는 함수를 추가!
})
.then(function(token) {
	console.log(token); //토큰을 출력!
  const fcmToken = token
  console.log(fcmToken);

})
.catch(function(err) {
	console.log('fcm에러 : ', err);
})

messaging.onMessage(function(payload){
	console.log(payload.notification.title);
	console.log(payload.notification.body);
})
messaging.onMessage(function(payload) {
	alert('Got a ' + payload.notification.title + '\n' + payload.notification.body);
})


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

    console.log(this.fcmToken);

    const tempStyle={
      "textAlign": "center",
      "padding": "20px",
    }

    function fetchData(){
      const result = axios.get('http://api.mingo.pe.kr/notice_v_1_0_0/notice_list?notice_type=0&page_num=1'
      ,).then(function(data) {
        console.log(data.data.data_array);
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

    const sendMessage = () => {
      console.log(this.fcmToken);
      const option = {
      	method: 'POST',
      	url: 'https://fcm.googleapis.com/fcm/send',
      	json: {
      		'to': 'f7fdTmbjBu4v4dg3yMFLUF:APA91bG0en6feYhONkc6Rz70Aiys1uNFsH9mvLymf12eH5osvrusR2Xrg2ovTt5O1EmF8dHlTXHyr1E79VhfYYAxOtQ7JHbQzxzkNrAa3ta-LwHIPJGPk_Q5qlVBLytW2K6RtRaESb4j',
      		'notification': {
      			'title': 'hello',
      			'body': 'world!',
      			'click_action': 'http://localhost:3000/', //이 부분에 원하는 url을 넣습니다.
      		}
      	},
      	headers: {
      		'Content-Type': 'application/json',
      		'Authorization': 'key=AAAAHkF0Xww:APA91bHRPxHCNrvy-D578fD7G7SYlPJeTov3O-DHHaytWYNQ57XCpoDotHTAi_LJ7bE3nyLdIHFi6CbRq_aHwG-ZkQStMjwpa4kVRH2kmdWqE-evmFX-fPM0eyyAP8yfL0wSHa8Wx-_J'
      	}
      }

      request(option, (err, res, body) => {
      	if(err) console.log(err); //에러가 발생할 경우 에러를 출력
      	else console.log(body); //제대로 요청이 되었을 경우 response의 데이터를 출력
      })

    }


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
                        <button onClick={()=>sendMessage()}>Send Push Message</button>
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
        <VerticalPopup
          modal_show = {this.state.modal_show}
          modal_close_login = {this.modal_close_login}
        />
      </div>



    );
  }
}

export default App;
