import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import { Home, About, Menu } from '../pages';
import axios from 'axios';


class App extends Component {

    render() {
        function fetchData(){
          const result = axios.get('http://api.mingo.pe.kr/notice_v_1_0_0/notice_list?notice_type=0&page_num=1'
          ,).then(function(data) {
            console.log(data.data.data_array);
            let api_data = data.data.data_array;
            const noticeList = api_data.map(
                (data_obj) => ( <li>{data_obj.notice_idx} : {data_obj.title}</li> )
            );
            console.log(noticeList);
          });

        }
        fetchData();

        return (
            <div>
              <Menu></Menu>
              <div>
                  <Route exact path="/" component={Home}/>
                  <Switch>
                      <Route path="/about/:name" component={About}/>
                      <Route path="/about" component={About}/>
                  </Switch>

              </div>

            </div>

        );
    }
}

export default App;
