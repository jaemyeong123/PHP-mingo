import React from 'react';
import queryString from 'query-string';

const About = ({location, match}) => {
    const query = queryString.parse(location.search);
    console.log(query);
    return (
        <div>
            <h2><a href="/Home">About</a></h2>
            <h2>전달된 파라미터 : {match.params.name}</h2>
        </div>
    );
};


export default About;
