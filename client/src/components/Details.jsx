import { Link, useParams } from "react-router-dom";
import { CiHeart } from "react-icons/ci";
import { useState } from "react";
import { FaHeart } from "react-icons/fa";

export const Details = ({ cid ,image, details, title, price }) => {

  const {id} = useParams();
  // State to manage likes (assuming you have a way to set the initial state)
  const [likes, setLikes] = useState(10);
  const [isLiked, setIsLiked] = useState(false);

  // Toggle the liked state and prevent navigation
  const handleLikeClick = (e) => {
    e.stopPropagation(); // Prevents the link navigation
    setIsLiked(!isLiked);
    setLikes(isLiked ? likes - 1 : likes + 1); // Adjust likes count accordingly
  };
  return (
      <div>
        <div className="w-[270px] h-[361px] bg-blue-100 rounded-sm overflow-hidden shadow-sm cursor-pointer transition-all duration-200 hover:scale-[1.02]">
          <Link to={`/category/${id}/details/${cid}`} className="w-full h-[66%] bg-purple-300 flex justify-center items-center overflow-hidden">
            <img className="w-full" src={image} alt="image" />
          </Link>
          <h2 className="px-2 pt-1">{details}</h2>
          <h1 className="text-lg px-2 capitalize font-bold">{title}</h1>
          <div className="flex justify-between w-full px-2">
            <h1 className="font-600 text-lg ">{price}$</h1>
            <h2 className="text-[1rem]">10 Likes</h2>
          </div>

          <div className="flex justify-between items-center w-full px-2 pt-2 relative">
            <div>3 Comments</div>
            <button className="text-[1.8rem] px-2 z-100" onClick={handleLikeClick}>
              {isLiked?<FaHeart className="text-red-500"/>: <CiHeart/>}
            </button>
          </div>
        </div>
      </div>
  );
};
