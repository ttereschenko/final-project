import React, {useEffect, useRef, useState} from 'react';
import ReactDOM from 'react-dom/client';
import {useParams} from "react-router-dom";

function WishlistButton() {
//     const { property } = useParams();
//     const dataLoaded = useRef(false);
//     const [favourite, setFavourite] = useState(null);
//
//     useEffect(() => {
//         if (dataLoaded.current) {
//             return
//         }
//
//         dataLoaded.current = true;
//
//         const url = `http://finalwork.test/api/wishlist/${property}/add`;
//
//         fetch(url)
//             .then(response => response.json())
//             .then(json => setFavourite(json.data));
//
//     }, []);

    return (
        <div>
            {/*<button className="btn btn-sm">*/}
            {/*    <i className="bi bi-heart"></i>ADD*/}
            {/*</button>*/}
        </div>
    )
}

export default WishlistButton;

if (document.getElementById('wishlist')) {
    const Index = ReactDOM.createRoot(document.getElementById("wishlist"));

    Index.render(
        <React.StrictMode>
            <WishlistButton/>
        </React.StrictMode>
    )
}
