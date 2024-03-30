import { useParams } from "react-router-dom";
import { newArrival } from "../data";
import { comments } from "../data";
import Comment from "./Comment";
import Rate from "./Rate";
import Textarea from "./Textarea";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { Card } from "./Card";

const CardDetails = () => {
  const { id } = useParams();

  return (
    <div>
      {newArrival
        .filter((card) => card.id == id)
        .map((card) => {
          return (
            <>
              <div
                className="flex flex-col justify-center items-center p-4"
                key={card.id}
              >
                <div className="w-[500px] h-[500px] overflow-hidden flex justify-center items-center">
                  <img className="w-full" src={card.image} alt="image" />
                </div>
                <h1 className="text-2xl mt-2">{card.title}</h1>
                <div className="flex w-[99vw] items-center justify-center p-2">
                  <Rate />
                </div>
                <div className="text-xl flex items-center text-white gap-4 bg-green-600 py-2 px-4 rounded-lg mt-1">
                  <HiOutlineShoppingCart />
                  {card.price}$
                </div>
                
              </div>
              <div className="container mx-auto my-5 ">
                <h1 className="text-2xl">More Details</h1>
                <p className=" text-[1.2rem]">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Incidunt, non inventore ratione nobis tempore, perferendis
                  natus exercitationem voluptas laborum repellat molestias
                  dolores assumenda aspernatur et adipisci? Corrupti consectetur
                  id quasi? Lorem ipsum dolor sit amet consectetur adipisicing
                  elit. Voluptates consectetur ex aliquid nostrum expedita
                  inventore ipsa impedit iure dolor veritatis.
                </p>
              </div>
            </>
          );
        })}

      <div className="container mx-auto grid grid-cols-5">
        <Card/>
        <Card/>
        <Card/>
        <Card/>
        <Card/>
      </div>

      <div>
        <div className="container mx-auto flex justify-center border-t-2 border-gray-300 pt-4 mt-5">
          <Textarea />
        </div>

        <div className="flex flex-col py-4 mx-auto container gap-4 items-center mb-6">
            {comments
              .filter((comment) => comment.card_id == id)
              .map((comment) => (
                <Comment {...comment} key={comment.id} />
              ))}
          </div>
      </div>
    </div>
  );
};

export default CardDetails;
