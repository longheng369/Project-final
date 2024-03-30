import { Card } from "../components/Card";
import { newArrival } from "../data";

const NewArrival = () => {

  return (
    <div className="w-full pb-8 flex flex-col  items-center">
      <h2 className="text-[3rem] p-4">New Arrival</h2>
      <div className="flex justify-center gap-6 container  mb-6 ">
        {newArrival.map((d) => (
          <Card {...d} key={d.id} />
        ))}
      </div>
      <article
        className="container h-[400px] p-10 bg-green-300 relative"
        style={{
          backgroundImage:
            "url('https://marketplace.canva.com/EAFEH3mIUaM/1/0/1600w/canva-dark-grey-and-white-minimalist-new-fashion-collection-banner-nvaqxg-8iXI.jpg')",
          backgroundPosition: "center",
          backgroundSize: "cover",
        }}
      >
        <h1 className="font-bold text-3xl mb-8 text-white">Today Promotion</h1>
        
      </article>
    </div>
  );
};

export default NewArrival;
