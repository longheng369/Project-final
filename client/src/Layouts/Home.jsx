import { useState } from "react";
import Chat from "../components/Chat";
import Hero from "./Hero";
import NewArrival from "./NewArrival";
import ShopCategory from "./ShopCategory";
import { PiChatCenteredDotsFill } from "react-icons/pi";

const Home = () => {
  const [toggle, setToggle] = useState(true);

  return (
    <div>
      <button
        onClick={() => setToggle(!toggle)}
        className="bottom-4 right-4 fixed w-[60px] h-[60px] rounded-[50%] bg-gray-400 flex justify-center items-center text-[30px] text-white"
      >
        <PiChatCenteredDotsFill />
      </button>
      <div className={toggle ? "first hide" : "first"}>
        <div className="chat-container">
          {/* {data.map((d) => (
            <Chat {...d} key={d.id} />
          ))} */}
          <div>
            <h1>heheh</h1>
          </div>
        </div>
        {/* <Typing /> */}
      </div>
      <Hero />
      <NewArrival />
      <ShopCategory />
    </div>
  );
};

export default Home;
