import { useParams } from "react-router-dom";
import { categorysDetails } from "../data";
import { Card } from "./Card";
import SearchBar from "./SearchBar";
import React, { useRef, useState } from "react";


const Slide = () => {
 
  const { id } = useParams();
  const [initialValue, setInitialValue] = useState("");
  function value(e) {
    setInitialValue(e);
  }
  return (
    <div>
      <div className="flex w-[98.3vw] justify-center mt-4">
        <div></div>
        <SearchBar value={value} />
      </div>
      <div className="slide">
        <div className="flex items-center gap-10 p-6">
          {categorysDetails
            .filter((card) =>
              initialValue == ""
                ? card.category_id == id
                : card.title
                    .toString()
                    .toLowerCase()
                    .includes(initialValue.toString().toLowerCase())
            )
            .map((card) => {
              return <Card {...card} key={card.id} />;
            })}
        </div>
      </div>
    </div>

    // <Swiper
    //   onSwiper={setSwiperRef}
    //   slidesPerView={3}
    //   centeredSlides={true}
    //   spaceBetween={30}
    //   pagination={{
    //     type: "fraction",
    //   }}
    //   navigation={true}
    //   modules={[Pagination, Navigation]}
    //   className="mySwiper"
    // >
    //   <SwiperSlide>Slide 1</SwiperSlide>
    //   <SwiperSlide>Slide 2</SwiperSlide>
    //   <SwiperSlide>Slide 3</SwiperSlide>
    //   <SwiperSlide>Slide 4</SwiperSlide>
    // </Swiper>
  );
};

export default Slide;
