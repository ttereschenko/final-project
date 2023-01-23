import React from 'react';
import ReactDOM from 'react-dom/client';
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";

if (document.getElementById('carousel')) {
    const Index = ReactDOM.createRoot(document.getElementById("carousel"));

    Index.render(
        <React.StrictMode>
            <Carousel />
        </React.StrictMode>
    )
}
