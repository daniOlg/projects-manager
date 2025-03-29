import { SVGAttributes } from 'react';
import {FolderTree} from "lucide-react";

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <FolderTree {...props} />
    );
}
