import {Outlet} from 'react-router-dom'
import Nav from '../components/Nav'
import Footer from './Footer'
import { useRef } from 'react';
const RootLayout = () => {
  const footerRef = useRef(null);
  const scrollToFooter = () => {
    footerRef.current?.scrollIntoView({ behavior: 'smooth' });
  };
  return (
    <div>
        <Nav scrollToFooter={scrollToFooter}/>
        <Outlet/>
        <div ref={footerRef}>
          <Footer />
        </div>

    </div>
  )
}

export default RootLayout