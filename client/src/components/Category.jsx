import { Link } from "react-router-dom";

const Category = ({ id, image, title }) => {
  return (
    <Link to={`/category/${id}`}>
      <div className="h-[330px] rounded-sm overflow-hidden">
        <div className="w-full h-[80%] overflow-hidden bg-red-200 flex justify-center items-center">
          <img src={image} alt="image" className="w-full" />
        </div>
        <div className="flex items-center justify-center bg-gray-600 w-full h-[20%] px-2">
          <h1 className="text-xl text-white">{title}</h1>
        </div>
      </div>
    </Link>
  );
};

export default Category;
