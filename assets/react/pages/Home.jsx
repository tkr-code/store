import React from "react";
import Card from '../card/Card'
import styled from "styled-components";

import DefaultPicture from '/public/img/user/empty.png'
 
const freelanceProfiles = [
    {
        name: 'Jane Doe',
        jobTitle: 'Devops',
        picture: DefaultPicture,
    },
    {
        name: 'John Doe',
        jobTitle: 'Developpeur frontend',
        picture: DefaultPicture,
    },
    {
        name: 'Jeanne Biche',
        jobTitle: 'Développeuse Fullstack',
        picture: DefaultPicture,
    },
]

const CardsContainer = styled.div`
    display: grid;
    gap: 24px;
    grid-template-rows: 350px 350px;
    grid-template-columns: repeat(2, 1fr);
`
export default function (props) {
    return (
        <div>
            <h2>Page d'accueil</h2>
            <h1>            Freelances
            </h1>
            <CardsContainer>
                { freelanceProfiles.map((profile, index)=>(
                    <Card 
                    key={`${profile.name}-${index}`}
                    label={profile.jobTitle}
                    picture={profile.picture}
                    title={profile.title}
                    /> 
                    ))}
            </CardsContainer>
        </div>
    )
}