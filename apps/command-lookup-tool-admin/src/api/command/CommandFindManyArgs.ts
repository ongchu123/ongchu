import { CommandWhereInput } from "./CommandWhereInput";
import { CommandOrderByInput } from "./CommandOrderByInput";

export type CommandFindManyArgs = {
  where?: CommandWhereInput;
  orderBy?: Array<CommandOrderByInput>;
  skip?: number;
  take?: number;
};
