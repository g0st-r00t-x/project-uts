export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface ColumnVisibility {
    name: boolean;
    description: boolean;
    price: boolean;
    stock: boolean;
    category: boolean;
}


export type Category = {
    id: string | number;
    name: string;
    description: string;
}

// Define Product type
export interface Product {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    category: Category;
}

// Define Filters type
export interface Filters {
    search?: string;
    sort?: string;
    direction?: "asc" | "desc";
}
export type Link = {
    href?: string;
    url: string | null;
    label: string;
    active: boolean;
}

// Define Page Props type
export interface ProductPageProps {
    auth: {
        user: any;
    };
    products: {
        data: Product[];
        links: Array<Link>;
    };
    filters: Filters;
}

// Define column visibility type
export interface ColumnVisibility {
    name: boolean;
    description: boolean;
    price: boolean;
    stock: boolean;
    category: boolean;
}
// Tipe untuk fungsi format harga
export type FormatPrice = (price: number) => string;

// Tipe untuk fungsi handleSort
export type HandleSort = (column: string, direction: "asc" | "desc") => void;

// Tipe untuk props ProductTable
export interface ProductTableProps {
  products: Product[];
  columnVisibility: ColumnVisibility;
  formatPrice: FormatPrice;
  handleSort: HandleSort;
  filters: Filters;
}