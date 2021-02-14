import React from 'react';
import queryString from 'query-string';

const About = ({location, match}) => {
    const query = queryString.parse(location.search);
    return (
        <div>
            <h2 className="menu_name active">{match.params.name}</h2>
        </div>
    );
};


export default About;
